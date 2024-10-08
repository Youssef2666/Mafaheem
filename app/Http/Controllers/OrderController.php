<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 404);
        }
        $total = $this->calculateTotalPrice($cart);
        return $total;

        // Create the order with user_id
        $order = Order::create([
            'cart_id' => $cart->id,
            'user_id' => Auth::id(),
            'total_price' => $this->calculateTotalPrice($cart),
        ]);

        // Attach items to the order
        foreach ($cart->items as $cartItem) {
            $orderItem = new OrderItem([
                'item_id' => $cartItem->item_id,
                'item_type' => $cartItem->item_type,
                'order_id' => $order->id,
            ]);
            $order->items()->save($orderItem);
        }

        // Clear the cart
        $cart->items()->delete();

        return response()->json(['message' => 'Order created successfully!', 'order' => $order], 201);
    }

    private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;

        foreach ($cart->items as $cartItem) {
            $item = $cartItem->item; // This retrieves the polymorphic item

            // Log the item details for debugging
            Log::info("CartItem ID: " . $cartItem->id . ", Item: ", [
                'item_id' => $cartItem->item_id,
                'item_type' => $cartItem->item_type,
                'item' => $item,
            ]);

            if ($item && isset($item->price)) {
                $totalPrice += $item->price; // Ensure the item has a price attribute
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
