<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requestedBy()
    {
        return $this->hasOne(User::class, 'id', 'requested_by');
    }

    public function noPeople()
    {
        return $this->hasMany(trip_persons::class, 'request_id', 'id');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function mtrips(){
        return $this->hasMany(mtrips::class, 'request_id', 'id');
    }
}
