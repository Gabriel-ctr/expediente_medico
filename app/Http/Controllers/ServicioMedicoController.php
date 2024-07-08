<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicioMedico;
use App\Models\Medico;
use App\Models\Paciente;

class ServicioMedicoController extends Controller
{
    // Función para mostrar los servicios médicos
    public function index()
    {
        // Esto es para mostrar los servicios médicos en la vista index
        $servicios = ServicioMedico::latest()->paginate(4);
        return view('servicios.index', compact('servicios'));
    }

    // Función para crear un servicio médico
    public function create()
    {
        $medicos = Medico::all(); // Obtener todos los médicos
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        return view('servicios.create', compact('medicos', 'pacientes'));
    }

    // Función para guardar un servicio médico
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'costo' => 'required',
            'medico_id' => 'required',
            'paciente_id' => 'required',
        ]);
    
        ServicioMedico::create($request->all());
    
        return redirect()->route('servicios.index')->with('success', 'Servicio médico creado exitosamente.');
    }

    // Función para mostrar un servicio médico
    public function show($servicio)
    {
        $servicio = ServicioMedico::findOrFail($servicio);
        return view('servicios.show', compact('servicio'));
    }

    // Función para editar un servicio médico
    public function edit($servicio)
    {
        $servicio = ServicioMedico::findOrFail($servicio);
        $medicos = Medico::all(); // Obtener todos los médicos
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        return view('servicios.edit', compact('servicio', 'medicos', 'pacientes'));
    }

    // Función para actualizar un servicio médico
    public function update(Request $request, $servicio)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'costo' => 'required',
            'medico_id' => 'required',
            'paciente_id' => 'required',
        ]);

        // Se actualiza el servicio médico
        $servicio = ServicioMedico::findOrFail($servicio);
        $servicio->update($request->all());
        return redirect()->route('servicios.index')->with('success', 'Servicio médico actualizado exitosamente.');
    }

    // Función para eliminar un servicio médico
    public function destroy($servicio)
    {
        // Se elimina el servicio médico
        $servicio = ServicioMedico::findOrFail($servicio);
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio médico eliminado exitosamente.');
    }
}
