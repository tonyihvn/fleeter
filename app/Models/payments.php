<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(subscriptions::class, 'id', 'subscription_id');
    }


    public function business()
    {
        return $this->belongsTo(businesses::class, 'id', 'business_id');
    }
}
