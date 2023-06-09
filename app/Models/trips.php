<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trips extends Model
{
    protected $guarded = [];

    public function request()
    {
        return $this->hasOne(requests::class, 'id', 'request_id');
    }

    public function multipleTrip()
    {
        return $this->hasMany(mtrips::class, 'request_id', 'request_id');
    }

    public function vehicle()
    {
        return $this->hasOne(vehicles::class, 'id', 'vehicle_id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_id');
    }

    public function report()
    {
        return $this->hasMany(trip_reports::class, 'trip_id', 'id');
    }

    public function tripRoutes()
    {
        return $this->hasMany(routes::class, 'trip_id', 'id');
    }


    use HasFactory;
}
