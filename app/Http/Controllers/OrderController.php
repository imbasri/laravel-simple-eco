<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //
    public function checkout()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart->isEmpty()) {
            return Redirect::back()->with('error', 'Cart is empty');
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);
           //
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
        $orders = Order::all();
        return view('index_order', compact('orders'));
    }

    public function show_order(Order $order)
    {
        return view('show_order', compact('order'));
    }

    public function submit_payment_receipt(Order $order, Request $request)
    {
        // input file dari request
        $file = $request->file('payment_receipt');

        // check jika file kosong
        if ($file == null) {
            return Redirect::back()->with('error', 'Please upload payment receipt');
        }
        // setup nama file dengan format time + name + extension
        $path = time() . '_' . $order->id . "." . $file->getClientOriginalExtension();
        // simpan distorage local dengan folder public dan nama file $path dan file_get_contents adalah untuk membaca file
        Storage::disk('local')->put('public/payment/' . $path, file_get_contents($file));
        $order->update([
            'payment_receipt' => $path
        ]);

        return Redirect::back()->with('success', 'Payment receipt uploaded successfully');
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);
        return Redirect::back()->with('success', 'Payment confirmed');
    }
}
