<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_supplies extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(businesses::class, 'business_id', 'id');
    }
}
