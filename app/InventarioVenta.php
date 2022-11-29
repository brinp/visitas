<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioVenta extends Model
{
    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
    public function venta(){
        return $this->belongsTo(Venta::class);
    }
}
