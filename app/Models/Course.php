<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'level',
        'price',
        'duration',
        'instructor_id',
        'subscription_plan_id',
    ];

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withPivot('enrolled_at', 'completed_at', 'price_at_purchase')->withTimestamps();
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'course_ratings')
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function certificates()
    {
        return $this->belongsToMany(Course::class, 'certificates', 'user_id', 'course_id')->withPivot('issued_at')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_course');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_course')->withTimestamps();
    }

}
