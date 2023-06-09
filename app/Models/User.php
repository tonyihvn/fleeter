<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'staff_id',
        'phone_number',
        'designation',
        'facility_id',
        'department_id',
        'unit_id',
        'supervisor',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Supervisor()
    {
        return $this->hasOne(User::class, 'id', 'supervisor');
    }

    public function tasks()
    {
        return $this->hasMany(tasks::class, 'assigned_to', 'id');
    }

    public function facility()
    {
        return $this->hasOne(facilities::class, 'id', 'facility_id');
    }

    public function department()
    {
        return $this->hasOne(department::class, 'id', 'department_id');
    }

    public function unit()
    {
        return $this->hasOne(unit::class, 'id', 'unit_id');
    }
}
