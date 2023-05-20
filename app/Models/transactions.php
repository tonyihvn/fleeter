<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function From()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    public function To()
    {
        return $this->hasOne(User::class, 'id', 'to');
    }
    public function trip()
    {
        return $this->hasOne(trips::class, 'id', 'trip_id');
    }
}
