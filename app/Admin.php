<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guarded = [];
    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }
}
