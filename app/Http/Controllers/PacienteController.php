<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::latest()->paginate(4);
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $medicos = Medico::all();
        return view('pacientes.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:pacientes',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'alergias' => 'required',
            'enfermedades' => 'required',
            'medico_id' => 'required',
        ]);
        //dd($request->all());
        Paciente::create($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente creado exitosamente.');
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        $medicos = Medico::all();
        return view('pacientes.edit', compact('paciente', 'medicos'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'alergias' => 'required',
            'enfermedades' => 'required',
            'medico_id' => 'required',

        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente eliminado exitosamente.');
    }
}
