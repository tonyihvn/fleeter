<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trips extends Model
{
    protected $guarded = [];

    public function request()
    {
        return $this->hasOne(User::class, 'id', 'request_id');
    }
    public function vehicle()
    {
        return $this->hasOne(vehicles::class, 'id', 'vehicle_id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_id');
    }


    use HasFactory;
}
