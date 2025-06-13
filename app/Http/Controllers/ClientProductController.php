<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function index()
    {
        $products = Product::with('style')->get();

        return view('client.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('style');

        return view('client.product.show', compact('product'));
    }
}
