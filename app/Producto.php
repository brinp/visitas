<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    public function categoria(){ //$producto->categoria->nombre
        return $this->belongsTo(Categoria::class); //Pertenece a una categoria.
    }
    public function marca(){ //$producto->marca->nombre
        return $this->belongsTo(Marca::class); //Pertenece a una marca.
    }
    public function medida(){ //$producto->medida->nombre
        return $this->belongsTo(Medida::class); //Pertenece a una medida.
    }
    public function inventarios(){
        return $this->hasMany(Inventario::class);
    }
}
