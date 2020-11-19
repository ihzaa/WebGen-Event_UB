<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['title', 'desc', 'poster', 'date', 'categori_id'];
    public function categori()
    {
        return $this->belongsTo('App\Models\categori');
    }
}
