<?php
// app/Providers/RouteServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/cliente/dashboard'; // puedes cambiar según el rol luego

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        //
    }
}
