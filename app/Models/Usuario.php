<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'correo',
        'clave',
        'rol',
        'nombre'
    ];

    protected $hidden = [
        'clave',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }

    public function getAuthIdentifierName()
    {
        return 'correo';
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
        return $this->rol === 'administrador';
    }

    public function isVendedor()
    {
        return $this->rol === 'vendedor';
    }
    public function isCliente()
    {
        return $this->rol === 'cliente';
    }

    public function isClienteCanal()
    {
        return $this->rol === 'cliente-canal';
    }
}

