<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LicenciaController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Licencia/Index', [
            'licencias' => Licencia::with('marca', 'categoria')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Licencia/Create', [
            'marcas' => Marca::all(),
            'categorias' => Categoria::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:licencias,codigo',
            'precio' => 'required|numeric',
            'precio_mayorista' => 'nullable|numeric',
            'precio_renovacion' => 'nullable|numeric',
            'trasladable' => 'boolean',
            'deducible' => 'boolean',
            'formateable' => 'boolean',
            'compra_asistida' => 'boolean',
            'compartida' => 'boolean',
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Licencia::create($validated);

        return redirect()->route('licencias.index')->with('success', 'Licencia creada correctamente.');
    }

    public function edit(Licencia $licencia)
    {
        return Inertia::render('Licencia/Edit', [
            'licencia' => $licencia,
            'marcas' => Marca::all(),
            'categorias' => Categoria::all()
        ]);
    }

    public function update(Request $request, Licencia $licencia)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:licencias,codigo,' . $licencia->id,
            'precio' => 'required|numeric',
            'precio_mayorista' => 'nullable|numeric',
            'precio_renovacion' => 'nullable|numeric',
            'trasladable' => 'boolean',
            'deducible' => 'boolean',
            'formateable' => 'boolean',
            'compra_asistida' => 'boolean',
            'compartida' => 'boolean',
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $licencia->update($validated);

        return redirect()->route('licencias.index')->with('success', 'Licencia actualizada correctamente.');
    }

    public function destroy(Licencia $licencia)
    {
        $licencia->delete();

        return redirect()->route('licencias.index')->with('success', 'Licencia eliminada correctamente.');
    }

    public function show(Licencia $licencia)
    {
        return Inertia::render('Licencia/Show', [
            'licencia' => $licencia->load('marca', 'categoria')
        ]);
    }

}
