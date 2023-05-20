<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facilities extends Model
{
    protected $guarded = [];

    public function inventory()
    {
        return $this->hasMany('App\inventory', 'facility_id');
    }
}
