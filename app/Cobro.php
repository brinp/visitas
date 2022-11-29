<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    public function creditoventa(){
        return $this->belongsTo(Creditoventa::class);
    }
    public function arqueo(){
        return $this->belongsTo(Arqueo::class);
    }
}
