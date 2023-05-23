<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trip_persons extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function person()
    {
        return $this->hasOne(User::class, 'id', 'person_id');
    }
}
