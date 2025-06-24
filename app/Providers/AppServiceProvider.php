<?php
// archivo: app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Inertia::share([
            'auth' => [
                'user' => fn () => Auth::check() ? Auth::user() : null,
            ],
        ]);
    }

    public function register()
    {
        
    }
}
