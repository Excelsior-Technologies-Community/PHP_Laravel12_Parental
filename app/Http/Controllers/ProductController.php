<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PhysicalProduct;
use App\Models\DigitalProduct;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderby('id', 'asc')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        if ($request->type == 'physical') {
            PhysicalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status ?? 'active',
                'weight' => $request->weight,
                'shipping_cost' => $request->shipping_cost,
            ]);
        } else {
            DigitalProduct::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status ?? 'active',
                'download_link' => $request->download_link,
                'file_size' => $request->file_size,
            ]);
        }

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->status = $request->status ?? $product->status;

        if ($request->type == 'physical') {
            $product->weight = $request->weight;
            $product->shipping_cost = $request->shipping_cost;
            $product->download_link = null;
            $product->file_size = null;
        } else {
            $product->download_link = $request->download_link;
            $product->file_size = $request->file_size;
            $product->weight = null;
            $product->shipping_cost = null;
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('products.index');
    }
}