<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(businesses::class, 'business_id', 'id');
    }

    public function From()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    public function To()
    {
        return $this->hasOne(User::class, 'id', 'to');
    }
    public function subscription()
    {
        return $this->hasOne(subscriptions::class, 'id', 'subscription_id');
    }
}
