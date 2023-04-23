<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cpayments extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function business()
    {
        return $this->belongsTo(businesses::class, 'id', 'business_id');
    }
}
