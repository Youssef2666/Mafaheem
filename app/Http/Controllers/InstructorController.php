<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CourseResource;

class InstructorController extends Controller
{
    use ResponseTrait;
   public function index()
{
    $instructors = User::withCount('courses')
        ->with(['instructor', 'courses.enrollments']) 
        ->get()
        ->map(function ($instructor) {
            $totalStudents = $instructor->courses->sum(function ($course) {
                return $course->enrollments->count();
            });

            $courses = $instructor->courses->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'image' => $course->image,
                    'price' => $course->price,
                    'level' => $course->level,
                    'duration' => $course->duration,
                    'number_of_students' => $course->enrollments->count() // Return only the count of enrollments
                ];
            });

            // Return the structured instructor data
            return [
                'id' => $instructor->id,
                'name' => $instructor->name,
                'email' => $instructor->email,
                'email_verified_at' => $instructor->email_verified_at,
                'profile_photo_url' => $instructor->profile_photo_url,
                'image' => $instructor->image,
                'courses_count' => $instructor->courses_count,
                'instructor' => $instructor->instructor,
                'number_of_students' => $totalStudents,
                'courses' => $courses, // Return the manually structured course data
            ];
        });

    return $this->success($instructors);
}

    

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'required|string',
            'bio' => 'nullable|string',
        ]);

        if (Instructor::where('user_id', $validated['user_id'])->exists()) {
            return $this->success(
                message: 'المعلم موجود بالفعل لهذا المستخدم.', status: 409
            ); // Conflict status
        }

        $instructor = Instructor::create($request->all());

        return $this->success(message: 'تم حفظ بياناتك بنجاح', status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instructor = User::with('instructor', 'courses')->find($id);
        return $this->success($instructor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId, // Ensure unique email, ignoring the current user
            'password' => 'nullable|string|min:8|confirmed',
            'bio' => 'nullable|string', // Optional bio
            'phone' => 'nullable|string|max:15', // Optional phone, can set a max length
        ]);

        // Find the user (who is the instructor)
        $user = User::find($userId);

        if (!$user) {
            return $this->success([
                'message' => 'المستخدم غير موجود.',
            ], 404); // Not Found
        }

        // Update the user's name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']); // Hash the password
        }

        // Save the user's changes
        $user->save();

        // Update the instructor data
        $instructor = $user->instructor; // Assuming there is a one-to-one relationship
        if ($instructor) {
            $instructor->bio = $validated['bio'] ?? $instructor->bio; // Keep existing bio if not provided
            $instructor->phone = $validated['phone'] ?? $instructor->phone; // Keep existing phone if not provided
            $instructor->save(); // Save instructor changes
        }

        // Return a success response
        return $this->success([
            'message' => 'تم تحديث معلومات المعلم بنجاح.',
            'instructor' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'bio' => $instructor->bio,
                'phone' => $instructor->phone,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getInstructorCourses(string $id)
    {
        $instructor = User::with('courses')->find($id);
        return $this->success($instructor->courses);
    }
}
