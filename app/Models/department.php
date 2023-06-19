<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $guarded = [];

    public function facility()
    {
        return $this->hasOne(facilities::class, 'id','facility_id');
    }
}
