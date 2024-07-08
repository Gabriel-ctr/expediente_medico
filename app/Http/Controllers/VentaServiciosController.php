<?php

namespace App\Http\Controllers;

use App\Models\VentaServicio;
use App\Models\Servicio;
use App\Models\Paciente;
use App\Models\ServicioMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventasServicios = VentaServicio::latest()->paginate(10);
        return view('ventas_servicios.index', compact('ventasServicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los servicios para el formulario de venta de servicios
        $servicios = ServicioMedico::all();
        $pacientes = Paciente::all();
        
        return view('ventas_servicios.create', compact('servicios', 'pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:pacientes,id',
            'servicios' => 'required|array|min:1',
            'servicios.*.id' => 'required|exists:servicios,id',
            'servicios.*.precio' => 'required|numeric|min:0',
            'servicios.*.cantidad' => 'required|integer|min:1',
        ]);

        // Iniciar una transacción para asegurar la consistencia de los datos
        DB::beginTransaction();

        try {
            // Crear la venta de servicio principal
            $ventaServicio = new VentaServicio();
            $ventaServicio->fecha = $request->fecha;
            $ventaServicio->paciente_id = $request->paciente_id;
            $ventaServicio->save();

            // Adjuntar los servicios a la venta de servicios
            foreach ($request->servicios as $servicio) {
                // Calcular el total
                $total = $servicio['precio'] * $servicio['cantidad'];

                // Adjuntar el servicio a la venta de servicios utilizando la relación definida
                $ventaServicio->servicios()->attach($servicio['id'], [
                    'total' => $total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // Confirmar la transacción
            DB::commit();

            // Redireccionar o retornar una respuesta de éxito
            return redirect()->route('ventas_servicios.index')->with('success', 'La venta de servicios se ha registrado correctamente.');
        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();

            // Redireccionar de vuelta al formulario con mensaje de error
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaServicio  $ventaServicio
     * @return \Illuminate\Http\Response
     */
    public function show(VentaServicio $ventaServicio)
    {
        return view('ventas_servicios.show', compact('ventaServicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VentaServicio  $ventaServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(VentaServicio $ventaServicio)
    {
        // Obtener todos los servicios para el formulario de edición de venta de servicios
        $servicios = ServicioMedico::all();
        return view('ventas_servicios.edit', compact('ventaServicio', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaServicio  $ventaServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaServicio $ventaServicio)
    {
        // Validar los datos del formulario de edición de venta de servicios
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'servicios' => 'required|array|min:1',
            'servicios.*.id' => 'required|exists:servicios,id',
            'servicios.*.precio' => 'required|numeric|min:0',
        ]);

        // Actualizar la venta de servicios
        $ventaServicio->update([
            'fecha' => $request->fecha,
            'total' => $request->total,
        ]);

        // Sincronizar los servicios de la venta de servicios
        $ventaServicio->servicios()->detach();
        foreach ($request->servicios as $servicio) {
            $ventaServicio->servicios()->attach($servicio['id'], [
                'precio' => $servicio['precio'],
            ]);
        }

        // Redireccionar a la vista de detalles de la venta de servicios o a donde desees
        return redirect()->route('ventas_servicios.index')->with('success', 'La venta de servicios se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaServicio  $ventaServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaServicio $ventaServicio)
    {
        // Eliminar la venta de servicios y los registros relacionados en la tabla pivote
        $ventaServicio->servicios()->detach();
        $ventaServicio->delete();

        // Redireccionar a la lista de ventas de servicios o a donde desees
        return redirect()->route('ventas_servicios.index')
                         ->with('success', 'La venta de servicios se ha eliminado correctamente.');
    }
}

