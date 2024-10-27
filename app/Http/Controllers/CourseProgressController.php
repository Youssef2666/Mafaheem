<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseProgressController extends Controller
{
    public function completeLecture(Request $request, $courseId, $lessonId, $lectureId)
    {
        $progress = UserProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $courseId,
                'lesson_id' => $lessonId,
                'lecture_id' => $lectureId,
            ],
            ['completed' => true]
        );

        // Return success response
        return response()->json([
            'message' => 'Lecture marked as completed.',
            'progress' => $progress,
        ]);
    }

    public function getCourseProgress($courseId)
    {
        $user = Auth::user();

        $course = Course::with('lessons.lectures')->findOrFail($courseId);

        $totalLectures = $course->lessons()->withCount('lectures')->get()->sum('lectures_count');

        $completedLectures = UserProgress::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('completed', true)
            ->count();

        $progressPercentage = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;

        return response()->json([
            'progress_percentage' => round($progressPercentage, 2),
            'total_lectures' => $totalLectures,
            'completed_lectures' => $completedLectures,
        ]);
    }

}
