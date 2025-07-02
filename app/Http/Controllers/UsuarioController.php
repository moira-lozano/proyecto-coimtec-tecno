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
        /* if (!in_array(Auth::user()->rol, ['administrador', 'vendedor'])) {
            abort(403); // Acceso denegado si no es admin o vendedor
        } */

        return Inertia::render('Usuario/Dashboard', [
            'auth' => ['user' => Auth::user()],
        ]);
    }

    public function index()
    {
        return Inertia::render('Usuario/Index', [
            'usuarios' => Usuario::with('roles')->get(), // Cargar usuarios con sus roles
            //'roles' => Role::all(), // Todos los roles disponibles para selects/filtros
        ]);
    }

    public function create()
    {
        return Inertia::render('Usuario/Create', [
            'roles' => Role::all()->pluck('name'), // Solo los nombres como array de strings
        ]);
    }

    public function store(Request $request)
    {
        // Obtener todos los nombres de roles válidos dinámicamente
        $rolesValidos = Role::pluck('name')->toArray();
        
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|min:6',
            'rol' => ['required', 'string', Rule::in($rolesValidos)], // Usar roles dinámicos
            'nombre' => 'required|string|max:255',
            'carnet' => 'required|string|max:255',
        ]);

        $usuario = Usuario::create([
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'rol' => (string) $request->rol,
            'nombre' => $request->nombre,
        ]);

        // También asignar el rol de Spatie al usuario
        $usuario->assignRole($request->rol);

        if ($request->rol === 'vendedor') {
            Vendedor::create([
                'carnet' => $request->carnet,
                'nombre' => $request->nombre,
                'id_usuario' => $usuario->id,
            ]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario y Vendedor registrados');
    }

    public function edit(Usuario $usuario)
    {
        $usuario->load('vendedor');

        return Inertia::render('Usuario/Edit', [
            'usuario' => $usuario,
            'roles' => Role::all()->pluck('name'), // Agregar roles para el edit
        ]);
    }


 public function update(Request $request, Usuario $usuario)
    {
        $rolesValidos = Role::pluck('name')->toArray();
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('usuarios')->ignore($usuario->id)],
            'clave' => 'nullable|string|min:6',
            'rol' => ['required', 'string', Rule::in($rolesValidos)],
            'carnet' => 'nullable|string|max:255',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->rol = (string) $request->rol;

        if ($request->filled('clave')) {
            $usuario->clave = Hash::make($request->clave);
        }

        $usuario->save();
        
        // Sincronizar el rol de Spatie
        $usuario->syncRoles([$request->rol]);

        if ($request->rol === 'vendedor') {
            $vendedor = Vendedor::where('id_usuario', $usuario->id)->first();

            if ($vendedor) {
                $vendedor->carnet = $request->carnet;
                $vendedor->nombre = $request->nombre;
                $vendedor->save();
            } else {
                Vendedor::create([
                    'carnet' => $request->carnet,
                    'nombre' => $request->nombre,
                    'id_usuario' => $usuario->id,
                ]);
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
