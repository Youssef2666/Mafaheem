<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ResponseTrait;





    public function index()
    {
        $orders = Auth::user()->orders;
        return $this->success($orders, 'Orders retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'coupon_code' => 'nullable|string',
        ]);

        // Retrieve the user's cart
        $cart = Cart::where('user_id', Auth::id())->with('courses')->first();

        if (!$cart || $cart->courses->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 404);
        }

        $totalPrice = $cart->courses->sum('price');
        $oldTotalPrice = $totalPrice;

        if (!empty($data['coupon_code'])) {
            
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            if (!$coupon || !$coupon->isValid() || !$coupon->hasRemainingUsage()) {
                return response()->json(['message' => 'Invalid or expired coupon'], 400);
            }
            $totalPrice = $coupon->applyDiscount($totalPrice);

            $coupon->increment('usage_count');
        }

        $order = Order::create([
            'cart_id' => $cart->id,
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cart->courses as $course) {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'enrolled_at' => now(),
                'price_at_purchase' => $course->price, // Set the price at the time of purchase
            ]);
        }

        // Clear the cart (detach the courses)
        $cart->courses()->detach();

        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order,
            'discounted_total_price' => $totalPrice,
            'original_total_price' => $oldTotalPrice,
        ], 201);
    }

    private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;

        foreach ($cart->items as $cartItem) {
            $item = $cartItem->item; // This retrieves the polymorphic item

            Log::info("CartItem ID: " . $cartItem->id . ", Item: ", [
                'item_id' => $cartItem->item_id,
                'item_type' => $cartItem->item_type,
                'item' => $item,
            ]);

            if ($item && isset($item->price)) {
                $totalPrice += $item->price;
            } else {
                // Log if the item or price is missing
                Log::warning("Price not found for item ID: " . $cartItem->item_id . ", Type: " . $cartItem->item_type);
            }
        }

        return $totalPrice;
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
    public function destroy(string $item_id, string $item_type)
    {
        //
    }
}
