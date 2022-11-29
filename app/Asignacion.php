<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    public function usuario(){ //$Caja->Usuario->Id
        return $this->belongsTo(Usuario::class);
    }
    public function sucursal(){ //$Caja->Usuario->Id
        return $this->belongsTo(Sucursal::class);
    }
}
