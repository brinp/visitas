<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoOrdenservicio extends Model
{
    protected $table = 'pago_ordenservicios';
    protected $with = ['ordenservicio','arqueo'];
    public function arqueo(){
        return $this->belongsTo(Arqueo::class);
    }
    public function ordenservicio(){
        return $this->belongsTo(Ordenservicio::class);
    }
}
