<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //add to cart
    public function add_to_cart(Product $product, Request $request)
    {
        // gte = greater than or equal
        $request->validate([
            'amount' => 'required|gte:1'
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;

        Cart::create([
            'user_id'=>$user_id,
            'product_id'=>$product_id,
            'amount'=>$request->amount
        ]);

        return Redirect::route('index_product')->with('success', 'Product added to cart successfully');
    }

    //remove from cart
    public function remove_from_cart() {}
}
