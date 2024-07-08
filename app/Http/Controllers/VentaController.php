<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Medicamento;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::latest()->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los medicamentos para el formulario de venta
        $medicamentos = Medicamento::all();
        $pacientes = Paciente::all();
        
        return view('ventas.create', compact('medicamentos', 'pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'paciente_id' => 'required|exists:pacientes,id',
            'medicamentos' => 'required|array|min:1',
            'medicamentos.*.id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
            'medicamentos.*.precio' => 'required|numeric|min:0',
        ]);

        // Iniciar una transacción para asegurar la consistencia de los datos
        DB::beginTransaction();

        try {
            // Crear la venta
            $venta = new Venta();
            $venta->fecha = $request->fecha;
            $venta->total = $request->total;
            $venta->paciente_id = $request->paciente_id;
            $venta->save();

            // Adjuntar los medicamentos a la venta y restar la cantidad vendida del stock
            foreach ($request->medicamentos as $medicamento) {
                $med = Medicamento::find($medicamento['id']);
                if (!$med) {
                    throw new \Exception('Medicamento no encontrado.');
                }

                // Verificar si hay suficiente stock para la venta
                if ($med->cantidad < $medicamento['cantidad']) {
                    throw new \Exception('No hay suficiente stock para el medicamento: ' . $med->nombre);
                }

                // Crear el registro en la tabla pivote (venta_medicamento)
                $venta->medicamentos()->attach($medicamento['id'], [
                    'cantidad' => $medicamento['cantidad'],
                    'precio_unitario' => $medicamento['precio'],
                    'total' => $medicamento['cantidad'] * $medicamento['precio'], // Calcular el total aquí
                ]);

                // Restar la cantidad vendida del stock del medicamento
                $med->cantidad -= $medicamento['cantidad'];
                $med->save();
            }

            // Confirmar la transacción
            DB::commit();

            // Redireccionar a la vista de detalles de la venta o a donde desees
            return redirect()->route('ventas.index')->with('success', 'La venta se ha registrado correctamente.');

        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();

            // Mostrar el error y redirigir de vuelta al formulario de venta
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        // Obtener todos los medicamentos para el formulario de edición de venta
        $medicamentos = Medicamento::all();
        return view('ventas.edit', compact('venta', 'medicamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        // Validar los datos del formulario de edición de venta
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'medicamentos' => 'required|array|min:1',
            'medicamentos.*.id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
            'medicamentos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Actualizar la venta
        $venta->update([
            'fecha' => $request->fecha,
            'total' => $request->total,
        ]);

        // Sincronizar los medicamentos de la venta
        $venta->medicamentos()->detach();
        foreach ($request->medicamentos as $medicamento) {
            $venta->medicamentos()->attach($medicamento['id'], [
                'cantidad' => $medicamento['cantidad'],
                'precio_unitario' => $medicamento['precio_unitario'],
            ]);
        }

        // Redireccionar a la vista de detalles de la venta o a donde desees
        return redirect()->route('ventas.index')->with('success', 'La venta se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        // Eliminar la venta
        $venta->medicamentos()->detach();
        $venta->delete();

        // Redireccionar a la lista de ventas o a donde desees
        return redirect()->route('ventas.index')->with('success', 'La venta se ha eliminado correctamente.');
    }
}
