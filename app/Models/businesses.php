<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class businesses extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function businessgroup()
    {
        return $this->belongsTo(businessgroups::class, 'id', 'businessgroup_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function materials()
    {
        return $this->hasMany(materials::class, 'business_id', 'id');
    }

    public function suppliers()
    {
        return $this->hasMany(suppliers::class, 'business_id', 'id');
    }

    public function personnel()
    {
        return $this->hasMany(User::class, 'business_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(products::class, 'business_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(subscriptions::class, 'business_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(payments::class, 'business_id', 'id');
    }

    public function subplans()
    {
        return $this->hasMany(subscription_plans::class, 'business_id', 'id');
    }

    public function milestones()
    {
        return $this->hasMany(project_milestones::class, 'business_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(tasks::class, 'business_id', 'id');
    }
}
