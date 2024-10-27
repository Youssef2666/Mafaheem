<?php

namespace App\Http\Controllers;

use App\Models\RoadMapEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoadMapEnrollmentController extends Controller
{
    public function enrollInRoadMap(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'road_map_id' => 'required|exists:road_maps,id',
            'price_at_purchase' => 'required|numeric|min:0',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is already enrolled in this roadmap
        if (RoadMapEnrollment::where('user_id', $user->id)->where('road_map_id', $request->road_map_id)->exists()) {
            return response()->json(['message' => 'You are already enrolled in this roadmap.'], 400);
        }

        // Enroll the user in the roadmap
        $enrollment = RoadMapEnrollment::create([
            'user_id' => $user->id,
            'road_map_id' => $request->road_map_id,
            'enrolled_at' => now(),
            'price_at_purchase' => $request->price_at_purchase,
        ]);

        return response()->json([
            'message' => 'Successfully enrolled in the roadmap!',
            'enrollment' => $enrollment,
        ], 201);
    }

    public function viewEnrollments()
    {
        $user = Auth::user();

        // Retrieve all the roadmaps the user is enrolled in
        $enrollments = RoadMapEnrollment::with('roadMap.courses')
            ->where('user_id', $user->id)
            ->get();

        // Transform the enrollments to the desired structure
        $formattedEnrollments = $enrollments->map(function ($enrollment) {
            return [
                    'id' => $enrollment->roadMap->id,
                    'title' => $enrollment->roadMap->title,
                    'description' => $enrollment->roadMap->description,
                    'courses' => $enrollment->roadMap->courses->map(function ($course) {
                        return [
                            'id' => $course->id,
                            'title' => $course->title,
                            'description' => $course->description,
                            'subscription_plan_id' => $course->subscription_plan_id,
                            'instructor_id' => $course->instructor_id,
                            'image' => $course->image,
                            'level' => $course->level,
                            'price' => $course->price,
                            'duration' => $course->duration,
                            'what_you_will_learn' => $course->what_you_will_learn,
                            'requirements' => $course->requirements,

                        ];
                    }),
            ];
        });

        return response()->json([
            'message' => 'Enrollments retrieved successfully!',
            'enrollments' => $formattedEnrollments,
        ], 200);
    }

}
