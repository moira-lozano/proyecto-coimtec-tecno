<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request): Response
    {
        $user = $request->user();
        
        // Obtener los permisos del usuario
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        
        // Obtener los roles del usuario
        $roles = $user->getRoleNames()->toArray();
        
        return Inertia::render('Dashboard', [
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'correo' => $user->correo,
                'permissions' => $permissions,
                'roles' => $roles,
            ],
            // Puedes agregar más datos aquí si los necesitas
            'stats' => [
                'usuarios' => \App\Models\Usuario::count(),
                'clientes' => 0, // Agrega el modelo de clientes cuando lo tengas
                'productos' => 0, // Agrega el modelo de productos cuando lo tengas
                'ventas_mes' => 0, // Agrega la lógica para calcular ventas del mes
            ]
        ]);
    }
}