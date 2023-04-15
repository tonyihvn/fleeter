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

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id', 'id');
    }
}
