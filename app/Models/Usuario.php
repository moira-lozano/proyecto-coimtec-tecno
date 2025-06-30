<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    protected $table = 'usuarios';

    protected $fillable = [
        'correo',
        'clave',
        'nombre'
    ];

    protected $hidden = [
        'clave',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_usuario');
    }

    public function vendedor()
    {
        return $this->hasOne(Vendedor::class, 'id_usuario');
    }

    public function isAdmin()
    {
        return $this->hasRole('administrador');
    }

    public function isVendedor()
    {
        return $this->hasRole('vendedor');
    }
    public function isCliente()
    {
        return $this->hasRole('cliente');
    }

    public function isClienteCanal()
    {
        return $this->hasRole('cliente-canal');
    }
}

