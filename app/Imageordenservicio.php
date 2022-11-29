<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imageordenservicio extends Model
{
    public function ordenservicio(){
        return $this->belongsTo(Ordenservicio::class);
    }
}
