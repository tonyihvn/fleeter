<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscription_plans extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(businesses::class, 'id', 'business_id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(subscriptions::class, 'subscription_plan', 'id');
    }
}
