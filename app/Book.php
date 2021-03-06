<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }
}

