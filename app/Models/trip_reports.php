<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trip_reports extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function submitedBy()
    {
        return $this->hasOne(User::class, 'id', 'submited_by');

    }

    public function trip()
    {
        return $this->belongsTo(trip::class, 'id', 'trip_id');
    }
}
