<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditoventa extends Model
{
    public function venta(){
        return $this->belongsTo(Venta::class);
    }
    public function cobros(){
        return $this->hasMany(Cobro::class);
    }
}
