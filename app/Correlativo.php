<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlativo extends Model
{
    public function comprobante(){ //$orden->usuario->sigla
        return $this->belongsTo(Comprobante::class); //Pertenece a una documento.
    }
}
