<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Inertia::share('auth.user', function () {
            if (Auth::check()) {
                return [
                    'id' => Auth::id(),
                    'name' => Auth::user()->nombre,
                    'roles' => Auth::user()->getRoleNames(),
                    'permissions' => Auth::user()->getAllPermissions()->pluck('name'),
                ];
            }
            return null;
        });
    }
}
