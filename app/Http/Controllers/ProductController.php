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
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->type && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        if ($request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $products = $query->orderBy('id', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:physical,digital',
            'status' => 'required|in:active,inactive'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ];

        if ($request->type == 'physical') {
            PhysicalProduct::create($data);
        } else {
            DigitalProduct::create($data);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
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
        $request->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = $product->status == 'active' ? 'inactive' : 'active';
        $product->save();

        return redirect()->route('products.index')->with('success', 'Status changed successfully!');
    }
}