<?php

namespace App\Http\Controllers;

use App\Models\Categoria; 
use Illuminate\Http\Request;
use Inertia\Inertia; 

class CategoriaController extends Controller
{

    public function index()
    {
        return Inertia::render('Categoria/Index', [
            'categorias' => Categoria::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Categoria/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return Inertia::render('Categoria/Edit', [
            'categoria' => $categoria
        ]);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->licencias()->exists()) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoria porque tiene licencias asociadas.');
        }
    
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria eliminada correctamente.'); 
    }

    public function show(Categoria $categoria)
    {
        return Inertia::render('Categoria/Show', [
            'categoria' => $categoria
        ]);
    }

}
