<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $fillable = [
        'nombre',
        'sigla',
        'simbolo'

    ];
}
