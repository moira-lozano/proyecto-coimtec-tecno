<?php

namespace Database\Seeders;

use App\Models\Usuario;
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
        // PERMISOS
        $permisos = [
            'ver ventas',
            'ver reportes',
            'ver pagos',
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

        // USUARIOS DE PRUEBA
        
        // Super Admin
        $superAdminUser = Usuario::firstOrCreate([
            'correo' => 'admin@example.com',
        ], [
            'nombre' => 'Gerente General',
            'clave' => bcrypt('password'),
        ]);
        $superAdminUser->assignRole('super-admin');

        // Administrador
        $adminUser = Usuario::firstOrCreate([
            'correo' => 'administrador@example.com',
        ], [
            'nombre' => 'María Administradora',
            'clave' => bcrypt('password'),
        ]);
        $adminUser->assignRole('administracion');

        // Encargado de Almacén
        $almacenUser = Usuario::firstOrCreate([
            'correo' => 'almacen@example.com',
        ], [
            'nombre' => 'Carlos Almacén',
            'clave' => bcrypt('password'),
        ]);
        $almacenUser->assignRole('encargado_almacen');

        // Encargado Comercial
        $comercialUser = Usuario::firstOrCreate([
            'correo' => 'comercial@example.com',
        ], [
            'nombre' => 'Ana Comercial',
            'clave' => bcrypt('password'),
        ]);
        $comercialUser->assignRole('encargado_comercial');

        // Vendedor
        $vendedorUser = Usuario::firstOrCreate([
            'correo' => 'vendedor@example.com',
        ], [
            'nombre' => 'Pedro Vendedor',
            'clave' => bcrypt('password'),
        ]);
        $vendedorUser->assignRole('vendedor');

        $this->command->info('Usuarios creados:');
        $this->command->info('Super Admin: admin@example.com / password');
        $this->command->info('Administrador: administrador@example.com / password');
        $this->command->info('Encargado Almacén: almacen@example.com / password');
        $this->command->info('Encargado Comercial: comercial@example.com / password');
        $this->command->info('Vendedor: vendedor@example.com / password');
    }
}