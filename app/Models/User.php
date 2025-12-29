<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'role',
        'status'
    ];

    protected $hidden = ['password'];

    public function rentPosts()
    {
        return $this->hasMany(RentPost::class, 'user_id');
    }
}
