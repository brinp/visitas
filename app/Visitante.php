<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    public function documento(){ //$Cliente->documento->sigla
        return $this->belongsTo(Documento::class); //Pertenece a una documento.
    }
}
