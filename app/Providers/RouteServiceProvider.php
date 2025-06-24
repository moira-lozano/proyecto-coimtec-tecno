<?php
// app/Providers/RouteServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard'; // puedes cambiar según el rol luego

    public function boot()
    {
        
    }
    public function map()
    {
        //
    }

    public static function redirectToByRole()
    {
        $user = Auth::user();

        if (!$user) return '/login';

        return match ($user->rol) {
            'administrador', 'vendedor' => '/usuario/dashboard',
            'cliente' => '/cliente/dashboard',
            default => '/dashboard',
        };
    }
}
