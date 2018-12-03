<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaTransaccion extends Model
{
    protected $table = 'categoria_transac';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;
    protected $fillable = ['nombre','tipo_transac_id','usuario_id'];
}
