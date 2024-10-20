<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')->withPivot('enrolled_at', 'completed_at', 'price_at_purchase')->withTimestamps();
    }

    public function ratedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_ratings')
            ->withPivot('rating')
            ->withTimestamps();
    }
    public function ratedRoadmaps()
    {
        return $this->belongsToMany(RoadMap::class, 'rating_roadmap')
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function certificates()
    {
        return $this->belongsToMany(Course::class, 'certificates', 'user_id', 'course_id')->withPivot('name', 'image', 'code', 'download_link' ,'issued_at')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function userProgresses()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function completedLecturesInCourse(Course $course)
    {
        return $this->userProgresses()
                    ->whereHas('lecture.lesson.course', function($query) use ($course) {
                        $query->where('id', $course->id);
                    })
                    ->where('completed', true)
                    ->count();
    }

    public function roadMapEnrollments()
    {
        return $this->hasMany(RoadMapEnrollment::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function workshops(){
        return $this->belongsToMany(Workshop::class, 'user_workshop')->withTimestamps();
    }
}
