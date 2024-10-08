<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_roadmap');
    }

    public function calculateDiscountedPrice()
    {
        $totalPrice = $this->courses->sum('price'); // Sum the price of all courses
        $discountedPrice = $totalPrice * 0.9; // Apply a 10% discount
        return $discountedPrice;
    }

    public function cartItems()
    {
        return $this->morphMany(CartItem::class, 'item');
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'item');
    }

    public function enrollments()
    {
        return $this->hasMany(RoadMapEnrollment::class);
    }
}
