<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Puedes registrar bindings aquí si es necesario
    }

    public function boot()
    {
        Inertia::share([
            'auth' => [
                'user' => function () {
                    $user = Auth::user();

                    if (!$user) return null;

                    return [
                        'id' => $user->id,
                        'name' => $user->nombre,
                        'email' => $user->correo,
                        'roles' => $user->getRoleNames(), // 👈 esto debe devolver un array con los nombres de roles
                    ];
                },
            ],
        ]);
    }
}
