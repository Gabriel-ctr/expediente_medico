<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = Consulta::latest()->paginate(10);
        return view('consultas.index', compact('consultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        return view('consultas.create', compact('pacientes', 'medicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'motivo' => 'required|string',
            'sintomas' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'urgente' => 'boolean',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'nullable|exists:medicos,id',
            'presion_arterial' => 'nullable|integer',
            'temperatura' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'notas' => 'nullable|string',
            'total' => 'nullable|numeric',
        ]);

        Consulta::create($validatedData);

        return redirect()->route('consultas.index')->with('success', 'Consulta registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        return view('consultas.show', compact('consulta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        return view('consultas.edit', compact('consulta', 'pacientes', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'motivo' => 'required|string',
            'sintomas' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'urgente' => 'boolean',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'nullable|exists:medicos,id',
            'presion_arterial' => 'nullable|integer',
            'temperatura' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'notas' => 'nullable|string',
            'total' => 'nullable|numeric',
        ]);

        $consulta->update($validatedData);

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada exitosamente.');
    }
}

