<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
   protected $primaryKey = 'id'; // Ahora es 'id'
    public $incrementing = true;   // Ahora es auto-incrementable
    protected $keyType = 'int';    // Ahora es integer

    protected $fillable = [
        'carnet',
        'nombre',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
