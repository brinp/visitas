<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenservicio extends Model
{
    protected $with = ['imageordenservicios'];

    public function categoria(){ //$equipo->categoria->nombre
        return $this->belongsTo(Categoria::class); //Pertenece a una categoria.
    }
    public function marca(){ //$equipo->marca->nombre
        return $this->belongsTo(Marca::class); //Pertenece a una marca.
    }
    public function cliente(){ //$orden->cliente->sigla
        return $this->belongsTo(Cliente::class); //Pertenece a una documento.
    }
    public function arqueo(){ //$orden->usuario->sigla
        return $this->belongsTo(Arqueo::class); //Pertenece a una documento.
    }
    public function imageordenservicios(){
        return $this->hasMany(Imageordenservicio::class);
    }
    public function ordenservicioinventarios(){
        return $this->hasMany(OrdenservicioInventario::class);
    }
    public function productonoiventariadoordenservicios(){
        return $this->hasMany(ProductonoiventariadoOrdenservicio::class);
    }

}
