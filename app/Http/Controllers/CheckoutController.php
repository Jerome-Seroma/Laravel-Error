<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class CheckoutController extends Controller
{
    //
    public function create()
    {
        if(Cart::count() == 0) {
            return redirect()->route('dashboard')->with('error', 'Your cart is empty');
        }
        return view('checkout.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:1000',
        ]);

        $cartItems = Cart::content();

        foreach($cartItems as $orderItem)
        {
            $product = Product::find($orderItem -> id);

            if($product->stock < $orderItem->qty) {
                return redirect()->route('cart.index')->withErrors(['stock' => 'Not enough stock for ' . $product]);
            }
        }

        DB::transaction(function () use ($request)
        {
            $cartItems = Cart::content();
            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_address' => $request->shipping_address,
                'total' => Cart::total(2, '.', ''),
                'status' => 'pending',
            ]);

            foreach($cartItems as $orderItem)
            {
                $product = Product::find($orderItem -> id);
                $product -> decrement('stock', $orderItem->qty);
                
                OrderItem::create(
                    [
                    'order_id' => $order->id,
                    'product_id' => $orderItem->id,
                    'quantity' => $orderItem->qty,
                    'price' => $orderItem->price,
                ]);
            }
            Cart::destroy();
        });

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
