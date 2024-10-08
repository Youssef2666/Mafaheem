<?php

namespace App\Http\Controllers;

use App\Models\RoadMap;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class RoadMapController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        // Fetch all roadmaps with their associated courses
        $roadmaps = RoadMap::with('courses', 'courses.lessons', 'courses.lessons.lectures','courses.categories','courses.subscriptionPlan')->get();

        // Calculate the discounted price for each roadmap using the model method
        $roadmaps->transform(function ($roadmap) {
            $roadmap->discounted_price = $roadmap->calculateDiscountedPrice();
            return $roadmap;
        });

        return $this->success($roadmaps);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_ids' => 'required|array', // Validate as an array
            'course_ids.*' => 'exists:courses,id', // Ensure each ID exists in the courses table
        ]);

        $roadmap = RoadMap::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $roadmap->courses()->attach($request->course_ids);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Roadmap created successfully!',
            'roadmap' => $roadmap->load('courses'), // Optionally include the associated courses
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roadmap = RoadMap::with('courses')->find($id);
        $price = $roadmap->calculateDiscountedPrice();
        $originalPrice = $roadmap->courses()->sum('price');
        return $this->success([
            'original_price' => $originalPrice,
            'discounted_price' => $price,
            'roadmap' => $roadmap,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $roadmapId)
    {
        //
    }

    public function detachCourseFromRoadmap(Request $request, string $roadmapId)
    {
        // Find the roadmap
        $roadmap = Roadmap::findOrFail($roadmapId);

        // Check if the course is associated with the roadmap
        if (!$roadmap->courses()->where('courses.id', $request->course_id)->exists()) {
            return $this->error('Course not found in roadmap', 404);
        }

        // Detach the course from the roadmap
        $roadmap->courses()->detach($request->course_id);

        // Return a JSON response
        return $this->success(message: 'Course removed from roadmap successfully!', status: 200);
    }

    public function addCourses(Request $request, $roadmapId)
    {
        // Validate the request
        $request->validate([
            'course_ids' => 'required|array', // Validate as an array
            'course_ids.*' => 'exists:courses,id', // Ensure each ID exists in the courses table
        ]);

        // Find the roadmap by ID
        $roadmap = RoadMap::findOrFail($roadmapId);

        // Attach the new courses to the roadmap
        $roadmap->courses()->attach($request->course_ids);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Courses added to roadmap successfully!',
            'roadmap' => $roadmap->load('courses'), // Optionally include the associated courses
        ], 200);
    }
}
