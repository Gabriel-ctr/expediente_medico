<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::paginate(10);
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
        return view('medicamentos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        Medicamento::create($validatedData);

        return redirect()->route('medicamentos.index')
                         ->with('success', 'Medicamento creado exitosamente.');
    }

    public function show(Medicamento $medicamento)
    {
        return view('medicamentos.show', compact('medicamento'));
    }

    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $medicamento->update($validatedData);

        return redirect()->route('medicamentos.index')
                         ->with('success', 'Medicamento actualizado exitosamente.');
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('medicamentos.index')
                         ->with('success', 'Medicamento eliminado exitosamente.');
    }
}
