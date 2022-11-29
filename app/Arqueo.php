<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    protected $with = ['movimientoarqueos','ventas'];
    public function caja(){
        return $this->belongsTo(Caja::class);
    }
    public function usuario(){ //$orden->cliente->sigla
        return $this->belongsTo(Usuario::class); //Pertenece a una documento.
    }
    public function ordenservicios(){
        return $this->hasMany(Ordenservicio::class);
    }
    public function movimientoarqueos(){
        return $this->hasMany(Movimientoarqueo::class);
    }
    public function ventas(){
        return $this->hasMany(Venta::class);
    }
    public function compras(){
        return $this->hasMany(Compra::class);
    }
    public function pagos(){
        return $this->hasMany(Pago::class);
    }
    public function cobros(){
        return $this->hasMany(Cobro::class);
    }
    public function pagoordenservicios(){
        return $this->hasMany(PagoOrdenservicio::class);
    }
}
