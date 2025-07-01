<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Vendedor;
use App\Models\Usuario;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

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
            'usuarios' => Usuario::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Usuario/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|min:6',
            'rol' => ['required', 'string', Rule::in(['administrador', 'vendedor', 'cliente', 'cliente-canal'])],
            'nombre' => 'required|string|max:255',
            'carnet' => 'required|string|max:255',
        ]);

        $usuario = Usuario::create([
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'rol' => (string) $request->rol,
            'nombre' => $request->nombre,
        ]);

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
        $usuario->load('vendedor'); // Asegúrate de tener esta relación en el modelo Usuario

        return Inertia::render('Usuario/Edit', [
            'usuario' => $usuario,
        ]);
    }


 public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('usuarios')->ignore($usuario->id)],
            'clave' => 'nullable|string|min:6',
            'rol' => ['required', 'string', Rule::in(['administrador', 'vendedor', 'cliente', 'cliente-canal'])],
            'carnet' => 'nullable|string|max:255',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->rol = (string) $request->rol;

        if ($request->filled('clave')) {
            $usuario->clave = Hash::make($request->clave);
        }

        $usuario->save();

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
