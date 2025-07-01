<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Vendedor;
use App\Models\Usuario;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
   public function dashboard()
    {
        if (!in_array(Auth::user()->rol, ['administrador', 'vendedor'])) {
            abort(403); // Acceso denegado si no es admin o vendedor
        }

        return Inertia::render('Usuario/Dashboard', [
            'auth' => ['user' => Auth::user()],
        ]);
    }


    public function index()
    {
        return Inertia::render('Usuario/Index', [
            'usuarios' => Usuario::with('roles')->get(), // 👈 importante
        ]);
    }


    public function create()
    {
        $roles = Role::pluck('name'); // Esto te devuelve ["administracion", "comercial", ...]
        return Inertia::render('Usuario/Create', [
            'roles' => $roles,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|min:6|confirmed',
            'nombre' => 'required|string|max:255',
            'carnet' => 'required|string|max:255',
            'rol' => ['required', 'string', Rule::exists('roles', 'name')],
        ]);

        $usuario = Usuario::create([
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'nombre' => $request->nombre,
        ]);

        $usuario->assignRole($request->rol);

        if ($request->rol === 'vendedor') {
            Vendedor::create([
                'carnet' => $request->carnet,
                'nombre' => $request->nombre,
                'id_usuario' => $usuario->id,
            ]);
        }


        return redirect()->route('usuarios.index')->with('success', 'Usuario registrados');
    }

    public function edit(Usuario $usuario)
    {
        $usuario->load('roles', 'vendedor');
        $roles = Role::pluck('name');
        return Inertia::render('Usuario/Edit', [
            'usuario' => $usuario,
            'roles' => $roles,
        ]);
    }


    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('usuarios')->ignore($usuario->id)],
            'clave' => 'nullable|string|min:6',
            'rol' => ['required', 'string', Rule::exists('roles', 'name')],
            'carnet' => 'required|string|max:255', // ✅ requerido para todos
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;

        if ($request->filled('clave')) {
            $usuario->clave = Hash::make($request->clave);
        }

        $usuario->save();
        $usuario->syncRoles([$request->rol]);

        // Solo crear o actualizar en la tabla vendedor si el rol es "vendedor"
        if ($request->rol === 'vendedor') {
            $vendedor = Vendedor::firstOrNew(['id_usuario' => $usuario->id]);
            $vendedor->carnet = $request->carnet;
            $vendedor->nombre = $request->nombre;
            $vendedor->save();
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }



    public function show(Usuario $usuario)
    {
        $usuario->load('roles', 'vendedor'); // Carga roles y datos adicionales si es vendedor

        return Inertia::render('Usuario/Show', [
            'usuario' => $usuario,
        ]);
    }


    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
