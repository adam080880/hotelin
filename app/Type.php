<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];
    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function images()
    {
        return $this->hasMany('App\RoomImage');
    }

}
