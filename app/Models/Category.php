<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'category_course');
    }

    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'category_workshop')->withTimestamps();
    }

}
