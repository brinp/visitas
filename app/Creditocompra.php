<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditocompra extends Model
{
    public function compra(){
        return $this->belongsTo(Compra::class);
    }
    public function pagos(){
        return $this->hasMany(Pago::class);
    }

}
