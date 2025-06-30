<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario; // Usa tu modelo personalizado si no usas App\Models\User

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear permisos
        $permisoFinanzas = Permission::firstOrCreate([
            'name' => 'ver finanzas',
            'guard_name' => 'web',
        ]);

        $permisoVentas = Permission::firstOrCreate([
            'name' => 'ver ventas',
            'guard_name' => 'web',
        ]);

        $permisoEditar = Permission::firstOrCreate([
            'name' => 'editar productos',
            'guard_name' => 'web',
        ]);

        // Crear roles y asignar permisos
        $admin = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);
        $admin->givePermissionTo([$permisoFinanzas, $permisoVentas, $permisoEditar]);

        $cliente = Role::firstOrCreate([
            'name' => 'cliente',
            'guard_name' => 'web',
        ]);
        $cliente->givePermissionTo([$permisoVentas]);

        $vendedor = Role::firstOrCreate([
            'name' => 'vendedor',
            'guard_name' => 'web',
        ]);
        $vendedor->givePermissionTo([$permisoVentas]);

        // Crear un usuario de prueba y asignarle rol
        $user = Usuario::create([
            'nombre' => 'Admin Test',
            'correo' => 'admin@example.com',
            'clave' => bcrypt('password'), // Asegúrate de usar bcrypt
        ]);

        $user->assignRole('administrador');

        // Asignar permiso directo (opcional)
        $user->givePermissionTo('ver ventas');
    }
}
