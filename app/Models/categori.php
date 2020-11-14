<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categori extends Model
{
    public function event()
    {
        return $this->hasMany('App\Models\event');
    }
}
