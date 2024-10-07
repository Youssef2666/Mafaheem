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

        // Get the course with its lessons and lectures
        $course = Course::with('lessons.lectures')->findOrFail($courseId);

        // Count the total lectures in the course
        $totalLectures = $course->lessons()->withCount('lectures')->get()->sum('lectures_count');

        // Count the completed lectures for the user in this course
        $completedLectures = UserProgress::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('completed', true)
            ->count();

        // Calculate progress percentage
        $progressPercentage = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;

        // Return progress as a JSON response
        return response()->json([
            'progress_percentage' => round($progressPercentage, 2), // Round to two decimal points
            'total_lectures' => $totalLectures,
            'completed_lectures' => $completedLectures,
        ]);
    }

}
