<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPost extends Model
{
    use HasFactory;

    protected $table = 'rent_posts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'title',
        'price',
        'address',
        'description',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: RentPost thuộc về User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}