<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public function usuario(){ //$Caja->Usuario->Id
        return $this->belongsTo(Usuario::class);
    }
}
