<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadMapEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'road_map_id',
        'enrolled_at',
        'price_at_purchase'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roadMap()
    {
        return $this->belongsTo(RoadMap::class);
    }
}
