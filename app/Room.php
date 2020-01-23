<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
