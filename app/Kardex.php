<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
}
