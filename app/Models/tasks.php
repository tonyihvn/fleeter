<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function assignedTo()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function sentBy()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }


}
