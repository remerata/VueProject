<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullname', 'email', 'studentid', 'courseSection', 'gender', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
