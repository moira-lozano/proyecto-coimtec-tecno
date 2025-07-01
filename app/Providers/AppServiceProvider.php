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
        Inertia::share('auth.user', function () {
            if (Auth::check()) {
                return [
                    'id' => Auth::id(),
                    'name' => Auth::user()->nombre,
                    'roles' => Auth::user()->getRoleNames(), // roles
                    'permissions' => Auth::user()->getAllPermissions()->pluck('name'), // permisos
                ];
            }
            return null;
        });
    }
}
