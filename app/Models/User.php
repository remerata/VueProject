<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'fullname', 
        'email', 
        'studentid', 
        'courseSection', 
        'gender', 
        'password', 
        'role' // Corrected: No trailing comma
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
