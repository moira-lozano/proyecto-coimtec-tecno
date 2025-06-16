<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'carnet';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'carnet',
        'nombre',
        'ci',
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
