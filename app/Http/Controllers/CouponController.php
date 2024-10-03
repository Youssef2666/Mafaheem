<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class CouponController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $coupons = Coupon::all();
        return $this->success($coupons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = Coupon::create($request->all());
        return $this->success($coupon);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function assignCouponToCourse(Request $request){
        $data = $request->validate([
            'coupon_code' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Find the coupon by code
        $coupon = Coupon::where('code', $data['coupon_code'])->first();

        if (!$coupon || !$coupon->isValid() || !$coupon->hasRemainingUsage()) {
            return response()->json(['message' => 'Invalid or expired coupon'], 400);
        }

        // Find the course
        $course = Course::findOrFail($data['course_id']);

        // Check if this coupon is associated with this course
        if ($course->coupons->contains($coupon)) {
            return response()->json(['message' => 'Coupon already assigned to this course'], 400);
        }

        // Assign the coupon to the course
        $course->coupons()->attach($coupon->id);
        return $this->success($course, 'Coupon assigned successfully');

    }

    public function applyCoupon(Request $request)
    {
        $data = $request->validate([
            'coupon_code' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Find the coupon by code
        $coupon = Coupon::where('code', $data['coupon_code'])->first();

        if (!$coupon || !$coupon->isValid() || !$coupon->hasRemainingUsage()) {
            return response()->json(['message' => 'Invalid or expired coupon'], 400);
        }

        // Find the course
        $course = Course::findOrFail($data['course_id']);

        // Check if this coupon is associated with this course
        if (!$course->coupons->contains($coupon)) {
            return response()->json(['message' => 'Coupon not applicable to this course'], 400);
        }

        // Apply the percentage discount
        $originalPrice = $course->price;
        $discountedPrice = $coupon->applyDiscount($originalPrice);

        // Update usage count for the coupon
        $coupon->increment('usage_count');

        return response()->json([
            'original_price' => $originalPrice,
            'discounted_price' => $discountedPrice,
            'message' => 'Coupon applied successfully',
        ]);
    }

}
