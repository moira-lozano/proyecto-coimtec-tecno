<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo',
            'clave' => 'required|string|confirmed|min:8',
        ]);

        $user = Usuario::create([
            'nombre' => $request->name,
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'rol' => 'cliente',
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME); // asegurarte de tenerla importada y definida
         

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect()->route('dashboard');
    }
}
