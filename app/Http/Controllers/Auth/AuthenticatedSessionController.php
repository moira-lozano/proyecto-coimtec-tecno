<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status'           => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'correo' => ['required', 'email'],
            'clave'  => ['required'],
        ]);

        // Intentar login usando el campo 'correo' y 'clave'
        if (! Auth::attempt([
            'correo'   => $request->correo,
            'password' => $request->clave
        ], $request->boolean('remember'))) {
            return back()->withErrors([
                'correo' => 'Las credenciales no coinciden.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirección según rol
        return match ($user->rol) {
            'cliente'       => redirect()->route('cliente.dashboard'),
            'vendedor'      => redirect()->route('usuario.dashboard'),
            'administrador' => redirect()->route('usuario.dashboard'),
            default         => redirect()->route('dashboard'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
