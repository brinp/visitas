<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    public function area(){ //$orden->usuario->sigla
        return $this->belongsTo(Area::class); //Pertenece a una documento.
    }
}
