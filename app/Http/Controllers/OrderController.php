<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
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
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json(['message' => 'Your cart is empty.'], 404);
        }

        if ($cart->courses->isEmpty()) {
            return response()->json(['message' => 'Your cart has no courses.'], 404);
        }

        // Calculate total price from cart's courses
        $totalPrice = $cart->courses()->sum('price');

        // Create the order with cart_id
        $order = Order::create([
            'user_id' => Auth::id(),
            'cart_id' => $cart->id,
            'total_price' => $totalPrice,
        ]);

        // Attach courses to the order
        $order->courses()->attach($cart->courses->pluck('id'));

        $cart->courses()->detach(); // Clear the cart

        return response()->json(['message' => 'Order created successfully!', 'order' => $order], 201);
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
}
