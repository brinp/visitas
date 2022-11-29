<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $with = ['visitas'];
    public function visitas(){
        return $this->hasMany(Visita::class);
    }
    public function asignacion(){ //$orden->cliente->sigla
        return $this->belongsTo(Asignacion::class); //Pertenece a una documento.
    }

}
