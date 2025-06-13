<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += (float) $item['price'] * $item['quantity'];
        }
        
        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'count' => count($cart)
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado ao carrinho!',
            'count' => count($cart)
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            if ($request->quantity > 0) {
                $cart[$request->product_id]['quantity'] = $request->quantity;
            } else {
                unset($cart[$request->product_id]);
            }
            
            session()->put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Carrinho limpo!'
        ]);
    }
}