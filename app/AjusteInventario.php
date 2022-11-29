<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AjusteInventario extends Model
{
    public function arqueo(){
        return $this->belongsTo(Arqueo::class);
    }
    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
}
