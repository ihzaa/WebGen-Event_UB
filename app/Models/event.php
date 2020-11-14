<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    public function categori(){
        return $this->belongsTo('App\Models\categori');
    }
}
