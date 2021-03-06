<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
