<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //
    public function checkout()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart->isEmpty()) {
            Redirect::back()->with('error', 'Cart is empty');
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach ($cart as $c) {

            // delete stock
            $product = Product::find($c->product_id);
            $product->update([
                'stock' => $product->stock - $c->amount
            ]);

            // buat transaction untuk di order
            Transaction::create([
                'order_id' => $order->id,
                'product_id' => $c->product_id,
                'amount' => $c->amount
            ]);

            // delete cart sesuai id jika order sudah di checkout
            $c->delete();
        }
        return Redirect::back()->with('success', 'Checkout success');
    }

    public function index_order()
    {
        $order = Order::all();
        return view('index_order', compact('order'));
    }


}
