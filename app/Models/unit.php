<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $guarded = [];

    public function facility()
    {
        return $this->hasOne(facilities::class, 'id','facility_id');
    }

    public function department()
    {
        return $this->hasOne(department::class, 'id','department_id');
    }
}
