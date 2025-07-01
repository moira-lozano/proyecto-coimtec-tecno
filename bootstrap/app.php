<?php

use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        //api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function ($middleware) {
        // REGISTRAMOS el alias del middleware
        $middleware->alias([
            'permission' => PermissionMiddleware::class,
        ]);
    })
    ->withExceptions()
    ->create();


