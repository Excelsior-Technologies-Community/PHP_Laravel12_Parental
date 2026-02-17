<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PhysicalProduct;
use App\Models\DigitalProduct;

class ProductController extends Controller
{

    // Show all products
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }


    // Show create form
    public function create()
    {
        return view('products.create');
    }


    // Store product
    public function store(Request $request)
    {

        if ($request->type == 'physical') {
            PhysicalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        } else {
            DigitalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('products.index');

    }

    // Show single product
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }


    // Edit form
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit', compact('product'));
    }


    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index');
    }


    // Delete product
    public function delete($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index');
    }

}
