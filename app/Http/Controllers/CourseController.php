<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Review;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class CourseController extends Controller
{
    use ResponseTrait;
    
public function index(Request $request)
{
    $cacheKey = 'courses_' . md5(serialize($request->all()));

    $courses = Cache::remember($cacheKey, 60 * 60, function () use ($request) {
        return Course::query()
            ->when($request->search, function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->search}%");
            })
            ->when($request->category_id, function (Builder $builder) use ($request) {
                $builder->whereHas('categories', function (Builder $query) use ($request) {
                    $query->where('categories.id', $request->category_id);
                });
            })
            ->when($request->subscription_plan_id, function (Builder $builder) use ($request) {
                $builder->where('subscription_plan_id', $request->subscription_plan_id);
            })
            ->when($request->min_price && $request->max_price, function (Builder $builder) use ($request) {
                $builder->whereBetween('price', [$request->min_price, $request->max_price]);
            })
            ->when($request->min_price && !$request->max_price, function (Builder $builder) use ($request) {
                $builder->where('price', '>=', $request->min_price);
            })
            ->when(!$request->min_price && $request->max_price, function (Builder $builder) use ($request) {
                $builder->where('price', '<=', $request->max_price);
            })
            ->when($request->most_enrolled, function (Builder $builder) {
                $builder->withCount('enrollments')
                    ->orderBy('enrollments_count', 'desc');
            })
            ->with(['lessons.lectures', 'subscriptionPlan', 'categories', 'reviews'])
            ->get();
    });

    return $this->success([
        'total_courses' => $courses->count(),
        'courses' => CourseResource::collection($courses),
    ]);
}
    public function store(Request $request)
    {
        $data = $request->all();
        $course = Course::create($data);
        return $this->success($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with(['lessons.lectures', 'subscriptionPlan', 'categories', 'reviews'])->find($id);
        return $this->success(new CourseResource($course));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $course = Course::find($id);
        $course->update($data);
        return $this->success($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();
        return $this->success($course);
    }

    public function rateCourse(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5', // Ensure rating is between 1 and 5
        ]);

        $course = Course::findOrFail($data['course_id']);

        // Check if the user has already rated this course
        $existingRating = $course->ratings()->where('user_id', Auth::id())->exists();

        if ($existingRating) {
            return $this->error('You have already rated this course', 400);
        }

        // Attach the rating if it doesn't exist
        $course->ratings()->attach(Auth::id(), ['rating' => $data['rating']]);
        return $this->success($course, 'Course rated successfully');
    }

    public function issueCertificate(Request $request, Course $course)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the user is already enrolled in the course
        if (!$user->certificates()->where('course_id', $course->id)->exists()) {
            // Attach the course to the user's certificates
            $user->certificates()->attach($course->id, ['issued_at' => now()]);

            return response()->json(['message' => 'Certificate issued successfully.'], 200);
        }

        return response()->json(['message' => 'Certificate already issued.'], 400);
    }

    public function getMyCertificates2()
    {
        $user = Auth::user();
        $certificates = $user->certificates()->pivot();
        return $this->success($certificates);
    }

    public function getMyCertificates()
    {
        $user = Auth::user();
        $certificates = $user->certificates()->get();

        // Map the certificates to extract only the pivot data
        $pivotData = $certificates->map(function ($certificate) {
            return [
                'user_id' => $certificate->pivot->user_id,
                'course_id' => $certificate->pivot->course_id,
                'issued_at' => $certificate->pivot->issued_at,
                'created_at' => $certificate->pivot->created_at,
                'updated_at' => $certificate->pivot->updated_at,
            ];
        });

        return $this->success($pivotData);
    }

    public function makeReview(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'review' => 'required|string',
        ]);

        // Creating the review directly via the Review model
        Review::create([
            'user_id' => Auth::id(),
            'course_id' => $data['course_id'],
            'review' => $data['review'],
        ]);

        return response()->json(['message' => 'Review added successfully']);
    }

    public function getMyReviews()
    {
        $user = Auth::user();
        $reviews = $user->reviews()->get();
        return $this->success($reviews);
    }

    public function getCourseReviews(Course $course)
    {
        $reviews = $course->reviews()->get();
        return $this->success($reviews);
    }

    public function getRandomCourse(Request $request)
    {
        $randomCourse = Course::with(['lessons.lectures', 'subscriptionPlan', 'categories'])->inRandomOrder()->take(7)->get();
        return $this->success([
            'total_courses' => $randomCourse->count(),
            'courses' => CourseResource::collection($randomCourse),
        ]);
    }

    public function getMostOrderedCourses()
    {
        $courses = Course::query()
            ->withCount('enrollments')
            ->orderBy('enrollments_count', 'desc') 
            ->with(['lessons.lectures', 'subscriptionPlan', 'categories', 'reviews']) 
            ->get();

        return $this->success([
            'total_courses' => $courses->count(),
            'courses' => CourseResource::collection($courses),
        ]);
    }

}
