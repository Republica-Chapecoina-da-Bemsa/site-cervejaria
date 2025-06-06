<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

use function Termwind\style;

class StyleProductController extends Controller
{

    private function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Style $style)
    {
        $products = $style->products()->get();
        return view('styles.products.list', [
            'style' => $style,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Style $style)
    {
        return view('styles.products.form', [
            'style' => $style,
            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Style $style)
    {
        $this->validateProduct($request);
        $data = $request->all();
        $data['style_id'] = $style->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products/images', 'public');
            $data['image'] = $imagePath;
        }
        Product::create($data);

        return redirect()->route('styles.products.index',$style->id)->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Style $style)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Style $style, Product $product)
    {
        return view('styles.products.form', [
            'style' => $style,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Style $style, Product $product)
    {
        $this->validateProduct($request);
        $data = $request->all();
        $data['style_id'] = $style->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products/images', 'public');
            $data['image'] = $imagePath;
        }
        $product->update($data);

        return redirect()->route('styles.products.index',$style->id)->with('success', 'Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Style $style, Product $product)
    {
        if ($product->image) {
            $imagePath = public_path('storage/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('styles.products.index',$style->id)->with('success', 'Product deleted successfully.');
    }
    public function search(Request $request,Style $style)
    {
        $value = $request->input('value');
        $column = $request->input('column');

        $products =$style->products()->where($column, 'like', "%{$value}%")->get();

        return view('styles.products.list', [
            'products' => $products,
            'style' => $style,

        ]);
    }
}
//
