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

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
}