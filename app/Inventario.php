<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public function arqueo(){
        return $this->belongsTo(Arqueo::class);
    }
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
    public function inventarioventa(){
        return $this->belongsTo(InventarioVenta::class);
    }

}
