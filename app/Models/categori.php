<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categori extends Model
{
    protected $fillable = ['name'];
    public function event()
    {
        return $this->hasMany('App\Models\event');
    }
}
