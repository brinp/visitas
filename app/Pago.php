<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public function creditocompra(){ 
        return $this->belongsTo(Creditocompra::class); 
    }
    public function arqueo(){ 
        return $this->belongsTo(Arqueo::class); 
    }
}
