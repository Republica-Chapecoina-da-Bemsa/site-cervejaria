<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'style_id' => 'required|exists:styles,id',
        ]);
    }
    public function index()
    {
        $products = Product::all();
        return view('products.list', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.form', [
            'styles' => Style::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateProduct($request);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products/images', 'public');
            $data['image'] = $imagePath;
        }
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.form', [
            'product' => $product,
            'styles' => Style::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validateProduct($request);
        // Handle file upload if an image is provided
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products/images', 'public');
            $data['image'] = $imagePath;
        }
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            $imagePath = public_path('storage/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function search(Request $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');

        $products = Product::where($column, 'like', "%{$value}%")->get();

        return view('products.list', [
            'products' => $products,

        ]);
    }
}
