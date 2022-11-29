<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientoarqueo extends Model
{
    public function arqueo(){ //$orden->usuario->sigla
        return $this->belongsTo(Arqueo::class); //Pertenece a una documento.
    }
}
