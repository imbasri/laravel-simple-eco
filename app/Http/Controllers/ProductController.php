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
        $path = time() . '_' . $request->name . $file->getClientOriginalExtension();

        // simpan distorage local dengan folder public dan nama file $path dan file_get_contents adalah untuk membaca file
        Storage::disk('local')->put('public/', $path, file_get_contents($file));

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
}
