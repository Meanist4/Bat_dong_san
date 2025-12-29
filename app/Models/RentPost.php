<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentPost extends Model
{
    protected $primaryKey = 'rent_id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'deposit',
        'area',
        'address',
        'bedrooms',
        'bathrooms',
        'furnished',
        'contact_phone',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
