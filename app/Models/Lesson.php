<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'content', 'video_url'];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lectures(){
        return $this->hasMany(Lecture::class);
    }
}
