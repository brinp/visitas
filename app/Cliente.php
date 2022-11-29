<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    public function documento(){ //$Cliente->documento->sigla
        return $this->belongsTo(Documento::class); //Pertenece a una documento.
    }
    public function ordenservicios(){
        return $this->hasMany(Ordenservicio::class);
    }
}
