<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscriptions extends Model
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

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(payments::class, 'subscription_id', 'id');
    }

    public function subplan()
    {
        return $this->hasOne(subscription_plans::class, 'id', 'subscription_plan');
    }

    public function merged()
    {
        return $this->hasOne(merged_subs::class, 'id', 'subscriptions');
    }

}
