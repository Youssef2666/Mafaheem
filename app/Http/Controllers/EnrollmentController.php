<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    use ResponseTrait;

    public function index(){
        $enrollments = Auth::user()->enrollments;
        return $this->success([
            'total_enrollments' => $enrollments->count(),
            'enrollments' => $enrollments,
        ]);
    }
    
    public function enrollCourse(Request $request)
    {
        $data = $request->all();
        $data['enrolled_at'] = now();
        $enrollment = Auth::user()->enrollments()->attach($data['course_id'], $data);
        return $this->success($enrollment);
    }
}
