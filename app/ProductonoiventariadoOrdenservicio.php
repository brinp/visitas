<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductonoiventariadoOrdenservicio extends Model
{
    protected $with = ['ordenservicio'];
    public function ordenservicio(){
        return $this->belongsTo(Ordenservicio::class);
    }
}
