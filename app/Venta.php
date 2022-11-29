<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function correlativo(){
        return $this->belongsTo(Correlativo::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function arqueo(){
        return $this->belongsTo(Arqueo::class);
    }
    public function inventarioventas(){
        return $this->hasMany(InventarioVenta::class);
    }
}
