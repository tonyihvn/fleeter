<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mtrips extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function trip()
    {
        return $this->hasOne(trips::class, 'id', 'trip_id');
    }
}
