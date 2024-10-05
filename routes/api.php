<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\WorkshopController;
use App\Models\Enrollment;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::post('/forget-password', [PasswordController::class, 'sendResetLinkEmail']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/me', [AuthController::class, 'whoAmI'])->middleware('auth:sanctum');



//resources
Route::apiResource('/course-categories', CourseCategoryController::class);
Route::apiResource('/lessons', LessonController::class);
Route::apiResource('/courses', CourseController::class);
Route::apiResource('/subscriptions', SubscriptionPlanController::class);
Route::apiResource('/workshops', WorkshopController::class);
Route::apiResource('/enrollments', Enrollment::class);
Route::apiResource('/lectures', LectureController::class);
Route::apiResource('/coupons', CouponController::class);

Route::get('/users', [AuthController::class, 'getUsers']);
Route::post('/users/email/verification', [AuthController::class, 'resendEmailVerification'])->middleware('auth:sanctum');

//attach categories to course
Route::post('/test', [CourseCategoryController::class, 'test'])->middleware('auth:sanctum');

//enroll
Route::post('/enroll', [EnrollmentController::class, 'enrollCourse'])->middleware('auth:sanctum');
Route::post('courses/rate', [CourseController::class, 'rateCourse'])->middleware('auth:sanctum');
Route::get('/enroll/index', [EnrollmentController::class, 'index'])->middleware('auth:sanctum');

//certificate
Route::post('/courses/{course}/certificate', [CourseController::class, 'issueCertificate'])->middleware('auth:sanctum');
Route::get('/courses/certificate/get', [CourseController::class, 'getMyCertificates'])->middleware('auth:sanctum');

//reviews
Route::post('/courses/make/reviews', [CourseController::class, 'makeReview'])->middleware('auth:sanctum');
Route::get('/courses/get/reviews', [CourseController::class, 'getMyReviews'])->middleware('auth:sanctum');
Route::get('/courses/{course}/get/reviews', [CourseController::class, 'getCourseReviews'])->middleware('auth:sanctum');

//coupons
Route::post('/coupons/try/assign', [CouponController::class, 'assignCouponToCourse'])->middleware('auth:sanctum');
Route::post('/coupons/apply/coupon', [CouponController::class, 'applyCoupon'])->middleware('auth:sanctum');