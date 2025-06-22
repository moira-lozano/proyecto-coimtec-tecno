<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Cliente;
use App\Models\Usuario;
use Inertia\Inertia;

class ClienteController extends Controller
{

    public function dashboard()
    {
        return Inertia::render('Cliente/Dashboard', [
            'auth' => [
                'user' => Auth::user()
            ]
        ]);
    }

    public function index()
    {
        return Inertia::render('Cliente/Index', [
            'clientes' => Cliente::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Cliente/Create', [
            'usuarios' => Usuario::select('id', 'nombre')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'carnet' => 'required|unique:clientes,carnet',
            'nombre' => 'required|string|max:255',
            'nit' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'empresa' => 'nullable|string|max:255',
            'cod_pais1' => 'nullable|string|max:5',
            'celular1' => 'nullable|string|max:20',
            'cod_pais2' => 'nullable|string|max:5',
            'celular2' => 'nullable|string|max:20',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $cliente)
    {
        $usuarios = \App\Models\Usuario::select('id', 'nombre')->get();


        return Inertia::render('Cliente/Edit', [
            'cliente' => $cliente,
            'usuarios' => $usuarios,
        ]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'carnet' => [
                'required',
                Rule::unique('clientes', 'carnet')->ignore($cliente->id),
            ],
            'nombre' => 'required|string|max:255',
            'nit' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'empresa' => 'nullable|string|max:255',
            'cod_pais1' => 'nullable|string|max:5',
            'celular1' => 'nullable|string|max:20',
            'cod_pais2' => 'nullable|string|max:5',
            'celular2' => 'nullable|string|max:20',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index');
    }

    // En tu ClienteController.php, agrega este método:

    public function show(Cliente $cliente)
    {
        // Cargar la relación del usuario
        $cliente->load('usuario');

        return Inertia::render('Cliente/Show', [
            'cliente' => $cliente,
        ]);
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index');
    }
}
