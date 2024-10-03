<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class LectureController extends Controller
{
   use ResponseTrait;
    public function index()
    {
        $lectures = Lecture::all();
        return $this->success($lectures);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lecture = Lecture::create($request->all());
        return $this->success($lecture);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lecture = Lecture::find($id);
        return $this->success($lecture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $lecture = Lecture::find($id);
        $lecture->update($data);
        return $this->success($lecture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lecture = Lecture::find($id);
        $lecture->delete();
        return $this->success($lecture);
    }
}
