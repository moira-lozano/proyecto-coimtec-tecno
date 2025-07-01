<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // PERMISOS
        $permisos = [
            'ver ventas',
            'ver reportes', 
            'ver pagos',        // Nuevo
            'gestionar clientes',
            'ver inventario',   
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
        $encargado_comercial->givePermissionTo(['ver ventas', 'ver reportes', 'ver pagos', 'gestionar clientes']);
        
        $vendedor = Role::firstOrCreate(['name' => 'vendedor', 'guard_name' => 'web']);
        $vendedor->givePermissionTo(['ver ventas']);

        // USUARIO SUPER ADMIN
        $user = User::firstOrCreate([
            'correo' => 'admin@example.com',
        ], [
            'nombre' => 'Gerente General',
            'clave' => bcrypt('password'),
        ]);
    }
}
