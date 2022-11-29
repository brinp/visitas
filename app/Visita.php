<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $with = ['visitante'];
    public function visitante(){ //$Cliente->documento->sigla
        return $this->belongsTo(Visitante::class); //Pertenece a una documento.
    }
    public function responsable(){ //$Cliente->documento->sigla
        return $this->belongsTo(Responsable::class); //Pertenece a una documento.
    }
    public function turno(){
        return $this->belongsTo(Turno::class);
    }
}
