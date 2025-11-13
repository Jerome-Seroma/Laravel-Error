<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //Displays the cart page
    public function index()
    {
        $cartItems = Cart::content();
        return view('cart.index', compact('cartItems'));
    }

    public function store(Product $product)
    {
        Cart::add(
            $product->id,
            $product->name,
            1, //Quantity
            $product->price
        );
        return redirect()->route('cart.index')->with('success','Product added to cart!');
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}
