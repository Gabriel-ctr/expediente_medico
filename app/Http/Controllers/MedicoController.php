<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class MedicoController extends Controller
{
    public function index()
    {
        // Esto es para mostrar los médicos en la vista index
        $medicos = Medico::latest()->paginate(4);
        // Se retorna la vista index con los médicos
        return view('medicos.index', compact('medicos'));
    }

    // Función para crear un médico
    public function create()
    {
        // Se retorna la vista create
        return view('medicos.create');
    }
    // Función para guardar un médico
    public function store(Request $request)
    {
        // Se validan los campos del formulario
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'especialidad' => 'required',
            'telefono' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'direccion' => 'required',
            'cedula' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'estado' => 'required',
        ]);
        // Se crea el médico
        Medico::create($request->all());
        // Se redirecciona a la vista index con un mensaje de éxito
        return redirect()->route('medicos.index')->with('success', 'Médico creado exitosamente.');
    }

    public function show($medico)
    {
        // Se busca el médico por su id
        $medico = Medico::findOrFail($medico);
        // Se retorna la vista show con el médico
        return view('medicos.show', compact('medico'));
    }

    // Función para editar un médico
    public function edit($medico)
    {
        // Se busca el médico por su id
        $medico = Medico::findOrFail($medico);
        // Se retorna la vista edit con el médico
        return view('medicos.edit', compact('medico'));
    }

    public function update(Request $request, $medico)
    {
        // Se validan los campos del formulario
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'especialidad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'cedula' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'estado' => 'required',
        ]);
        // Se busca el médico por su id y se actualiza
        $medico = Medico::findOrFail($medico);
        $medico->update($request->all());
        // Se redirecciona a la vista index con un mensaje de éxito
        return redirect()->route('medicos.index')->with('success', 'Médico actualizado exitosamente.');
    }

    // Función para eliminar un médico
    public function destroy($medico)
    {
        // Se busca el médico por su id y se elimina
        $medico = Medico::findOrFail($medico); // findOrderOrFail es un método de Laravel que busca un registro por su id y si no lo encuentra lanza una excepción
        $medico->delete();
        // Se redirecciona a la vista index con un mensaje de éxito
        return redirect()->route('medicos.index')->with('success', 'Médico eliminado exitosamente.');
    }
}
