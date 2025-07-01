<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MarcaController extends Controller
{

    // Mostrar listado de marcas
    public function index()
    {
        $marcas = Marca::all();

        return Inertia::render('Marca/Index', [
            'marcas' => $marcas
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return Inertia::render('Marca/Create');
    }

    // Guardar una nueva marca
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre',
        ]);

        Marca::create($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Marca $marca)
    {

        \Log::info('Marca en edit:', ['marca' => $marca->toArray()]);
        return Inertia::render('Marca/Edit', [
            'marca' => $marca
        ]);
    }

    // Actualizar una marca existente
    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marca->id,
        ]);

        $marca->update($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
    }

    // Eliminar una marca
    public function destroy(Marca $marca)
    {
        if ($marca->licencias()->exists()) {
            return redirect()->route('marcas.index')
                ->with('error', 'No se puede eliminar la marca porque tiene licencias asociadas.');
        }
    
        $marca->delete();
        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminada correctamente.');    
    }

    public function show(Marca $marca)
    {
        return Inertia::render('Marca/Show', [
            'marca' => $marca
        ]);
    }
    
}
