<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    protected $fillable = [
        'nombre', 'codigo', 'precio',
        'precio_mayorista', 'precio_renovacion',
        'trasladable', 'deducible', 'formateable',
        'compra_asistida', 'compartida',
        'marca_id', 'categoria_id'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
