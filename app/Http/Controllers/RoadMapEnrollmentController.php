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
        // Get the currently authenticated user
        $user = Auth::user();

        // Retrieve all the roadmaps the user is enrolled in
        $enrollments = RoadMapEnrollment::with('roadMap')->where('user_id', $user->id)->get();

        // Return the enrollments with the roadmap details
        return response()->json([
            'message' => 'Enrollments retrieved successfully!',
            'enrollments' => $enrollments,
        ], 200);
    }

}
