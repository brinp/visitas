<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $with = ['documento'];
    public function documento(){ //$Cliente->documento->sigla
        return $this->belongsTo(Documento::class); //Pertenece a una documento.
    }

}
