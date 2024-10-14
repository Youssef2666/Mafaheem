<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Notifications\CourseNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendCourseNotification(Request $request)
    {
        // Find the course based on the course_id from the request
        $mycourse = Course::findOrFail($request->course_id);

        // Get unique enrolled users
        $enrolledUsers = $mycourse->enrollments->unique('id');

        // Loop through each user and send a notification
        foreach ($enrolledUsers as $user) {
            $user->notify(new CourseNotification($mycourse));
        }

        // Return the list of users who received the notification
        return response()->json(['message' => 'Notification sent to enrolled users.', 'users' => $enrolledUsers->values()]);
    }
}

