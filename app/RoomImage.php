<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $guarded = [];
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
