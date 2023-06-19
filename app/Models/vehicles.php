<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicles extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function facility()
    {
        return $this->hasOne(facilities::class, 'id', 'facility_id');
    }

    public function trips()
    {
        return $this->hasMany(trips::class, 'vehicle_id', 'id');
    }
}
