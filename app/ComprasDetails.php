<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComprasDetails extends Model
{
    protected $table = 'compra_producto';

    public function compra(){ //$producto->marca->nombre
        return $this->belongsTo(Compra::class); //Pertenece a una marca.
    }
    public function producto(){ //$producto->medida->nombre
        return $this->belongsTo(Producto::class); //Pertenece a una medida.
    }
}
