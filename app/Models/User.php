<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // THÊM DÒNG NÀY
        'is_admin',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'status'   => 'integer', // Ép kiểu để xử lý logic cho chính xác
    ];

    /**
     * Kiểm tra quyền Admin
     */
    public function isAdmin(): bool
    {
        // Kiểm tra qua is_admin HOẶC qua role (tùy theo logic bạn muốn dùng chính)
        return (bool) $this->is_admin || $this->role === 'admin';
    }

    /**
     * Quan hệ với bài đăng
     */
    public function rentPosts()
    {
        return $this->hasMany(RentPost::class);
    }
}