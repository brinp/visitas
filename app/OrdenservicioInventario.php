<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenservicioInventario extends Model
{
    public function ordenservicio(){ //$orden->cliente->sigla
        return $this->belongsTo(Ordenservicio::class); //Pertenece a una documento.
    }
    public function inventario(){ //$orden->cliente->sigla
        return $this->belongsTo(Inventario::class); //Pertenece a una documento.
    }
}
