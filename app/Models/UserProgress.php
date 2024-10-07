<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'lesson_id', 'lecture_id', 'completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
