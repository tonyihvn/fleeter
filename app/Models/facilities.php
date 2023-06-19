<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facilities extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->hasMany(department::class, 'facility_id','id');
    }

    public function units()
    {
        return $this->hasMany(unit::class, 'facility_id','id');
    }
}
