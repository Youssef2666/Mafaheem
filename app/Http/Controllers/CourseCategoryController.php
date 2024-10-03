<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\CourseCategory;
use App\Http\Resources\CourseCategoryResource;
use App\Http\Requests\StoreCourseCategoryRequest;

class CourseCategoryController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $courseCategories = Category::all();
        return $this->success(CourseCategoryResource::collection($courseCategories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseCategoryRequest $request)
    {
        $data = $request->validated();
        $courseCategory = Category::create($data);
        return $this->success(CourseCategoryResource::make($courseCategory));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $courseCategory = Category::find($id);
        return $this->success(CourseCategoryResource::make($courseCategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $courseCategory = Category::find($id);
        $courseCategory->update($data);
        return $this->success(CourseCategoryResource::make($courseCategory));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $courseCategory = Category::find($id);
        $courseCategory->delete();
        return $this->success(CourseCategoryResource::make($courseCategory));
    }

    public function test(Request $request){
        $course = Course::find(1);
        $course->categories()->attach([1, 2, 3]);
        return $this->success($course, 'Categories attached successfully');
    }
}
