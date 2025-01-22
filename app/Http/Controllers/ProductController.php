<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //create show
    public function create_product()
    {
        return view('create_product');
    }

    //store product
    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // input file dari request
        $file = $request->file('image');
        // setup nama file dengan format time + name + extension
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        // simpan distorage local dengan folder public dan nama file $path dan file_get_contents adalah untuk membaca file
        Storage::disk('local')->put('public/images/' . $path, file_get_contents($file));

        // save dengan modal Product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        //return redirect route create product
        return Redirect::route('create_product')->with('success', 'Product created successfully');
    }

    //show product
    public function index_product()
    {
        $products = Product::all();
        return view('index_product', compact('products'));
    }
    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    public function update_product(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // input file dari request
        $file = $request->file('image');
        // setup nama file dengan format time + name + extension
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        // delete file lama
        Storage::disk('local')->delete('public/images/' . $product->image);

        // simpan distorage local dengan folder public dan nama file $path dan file_get_contents adalah untuk membaca file
        Storage::disk('local')->put('public/images/' . $path, file_get_contents($file));

        // update dengan model Product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        //return redirect route create product
        return Redirect::route('index_product')->with('success', 'Product updated successfully');
    }

    // delete product
    public function delete_product(Product $product)
    {
        // hapus file di storage local agar tidak penuh
        Storage::disk('local')->delete('public/images/' . $product->image);
        // hapus data di database
        $product->delete();
        // redirect kembali ke halaman index
        return Redirect::route('index_product')->with('success', 'Product deleted successfully');

    }
}
