<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'capacity',
        'price',
        'instructor_id',
        'latitude',
        'longitude',
        'image'
    ];


    public function seatsLeft()
    {
        $enrolledUsersCount = $this->users()->count();
        return $this->capacity - $enrolledUsersCount;
    }



    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function cartItems()
    {
        return $this->morphMany(CartItem::class, 'item');
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workshop')->withTimestamps();
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_workshop')->withTimestamps();
    }
}
