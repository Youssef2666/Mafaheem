<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('courses')->first();

        if (!$cart) {
            return $this->success(null);
        }
        return $this->success(new CartResource($cart));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Find or create the cart for the user
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Attach the course to the cart
        $cart->courses()->attach($request->course_id);

        return response()->json(['message' => 'Course added to cart successfully!'], 200);
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
    public function destroy(string $course_id)
    {
        //
    }

    public function addToCart(Request $request)
    {
        //
    }

    public function viewCart()
    {
        //
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json(['message' => 'Your cart is empty.'], 404);
        }

        if (!$cart->courses()->where('course_id', $request->course_id)->exists()) {
            return response()->json(['message' => 'Course not found in your cart.'], 404);
        }

        $cart->courses()->detach($request->course_id);

        return response()->json(['message' => 'Course removed from cart successfully!'], 200);
    }

}
