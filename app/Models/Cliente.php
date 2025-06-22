<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id'; // Ahora es 'id'
    public $incrementing = true;   // Ahora es auto-incrementable
    protected $keyType = 'int';    // Ahora es integer

    protected $fillable = [
        'carnet',
        'nombre',
        'nit',
        'correo',
        'empresa',
        'cod_pais1',
        'celular1',
        'cod_pais2',
        'celular2',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
