<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public function proveedor(){ //$orden->proveedor->sigla
        return $this->belongsTo(Proveedor::class); //Pertenece a una documento.
    }
    public function arqueo(){ //$orden->usuario->sigla
        return $this->belongsTo(Arqueo::class); //Pertenece a una documento.
    }
    public function comprobante(){ //$orden->usuario->sigla
        return $this->belongsTo(Comprobante::class); //Pertenece a una documento.
    }
    public function comprasdetails(){
        return $this->hasMany(ComprasDetails::class);
    }
}
