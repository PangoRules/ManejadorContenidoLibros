<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $fillable = [
        'nombre',
        'catPadre',
    ];

    protected $table = 'categorias';

    protected $primaryKey = 'id';
}
