<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percentage',
        'usage_count',
        'usage_limit',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isValid()
    {
        return $this->expires_at === null || $this->expires_at->isFuture();
    }

    public function hasRemainingUsage()
    {
        return $this->usage_limit > $this->usage_count;
    }

    public function applyDiscount($originalPrice)
    {
        // Apply percentage-based discount
        return max($originalPrice * (1 - $this->discount_percentage / 100), 0);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'coupon_course')->withTimestamps();
    }

}
