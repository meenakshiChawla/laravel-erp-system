<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }
}
