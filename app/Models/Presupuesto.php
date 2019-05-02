<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuesto';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;
    protected $fillable = ['usuario_id', 'categoria_transac_id', 'valor','descripcion'];

    public function categoria()
    {
        return $this->belongsTo(\App\Models\CategoriaTransaccion::class,'categoria_transac_id');
    }
}
