<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    protected $table = 'transaccion';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;
    protected $fillable = ['cuenta_id', 'tipo_transac_id', 'categoria_transac_id', 'descripcion', 'valor','fecha'];
}
