<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class LessonController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $lessons = Lesson::with('lectures')->get();
        return $this->success($lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $lesson = Lesson::create($data);
        return $this->success($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = Lesson::find($id);
        return $this->success($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $lesson = Lesson::find($id);
        $lesson->update($data);
        return $this->success($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return $this->success($lesson);
    }

    public function getCourseLessons(string $id)
    {
        $course = Lesson::where('course_id', $id)->get();
        return $this->success($course);
    }
}
