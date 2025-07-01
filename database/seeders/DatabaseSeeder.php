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
        // PERMISOS
        $permisos = [
            'ver ventas',
            'ver reportes',
            'gestionar clientes',
            'ver inventario',
            'ver pagos',
            'gestionar usuarios',
            'ver marcas',
            'ver categorias',
            'ver licencias',

        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // ROLES
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'administracion', 'guard_name' => 'web']);
        $admin->givePermissionTo(['gestionar usuarios', 'gestionar clientes']);

        $encargado_almacen = Role::firstOrCreate(['name' => 'encargado_almacen', 'guard_name' => 'web']);
        $encargado_almacen->givePermissionTo(['ver marcas', 'ver categorias', 'ver licencias']);

        $encargado_comercial = Role::firstOrCreate(['name' => 'encargado_comercial', 'guard_name' => 'web']);
        $encargado_comercial->givePermissionTo(['ver ventas', 'ver reportes', 'gestionar clientes']);
        
        $vendedor = Role::firstOrCreate(['name' => 'vendedor', 'guard_name' => 'web']);
        $vendedor->givePermissionTo(['ver ventas']);

        // USUARIO SUPER ADMIN
        $user = Usuario::firstOrCreate([
            'correo' => 'admin@example.com',
        ], [
            'nombre' => 'Gerente General',
            'clave' => bcrypt('password'),
        ]);

        $user->assignRole('super-admin');
    }

}
