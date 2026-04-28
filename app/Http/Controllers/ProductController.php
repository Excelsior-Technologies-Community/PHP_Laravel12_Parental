<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PhysicalProduct;
use App\Models\DigitalProduct;

class ProductController extends Controller
{

    // Show all products (WITH SEARCH)
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderby('id', 'asc')->get();

        return view('products.index', compact('products'));
    }


    // Show create form
    public function create()
    {
        return view('products.create');
    }


    // Store product (WITH STATUS SUPPORT)
    public function store(Request $request)
    {

        if ($request->type == 'physical') {
            PhysicalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status ?? 'active',
            ]);
        } else {
            DigitalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status ?? 'active',
            ]);
        }

        return redirect()->route('products.index');
    }


    // Show single product
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }


    // Edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }


    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->status = $request->status ?? $product->status;

        $product->save();

        return redirect()->route('products.index');
    }


    // Delete product
    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('products.index');
    }

}