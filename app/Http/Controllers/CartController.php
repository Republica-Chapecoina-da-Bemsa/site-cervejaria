<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::all();
        return view("cart.list", [
            "cart" => $cart,
        ]);
    }
    public function add_item(Product $product, Request $request)
    {
        Cart::create([
            "product_id" => $product->id,
            "quantity" => $request->input("quantity", 1),
        ]);
         return redirect()->route("cart.index")->with("success", "Item added successfully.");

    }
    public function remove_item(Product $product, Request $request)
    {
        $item = Cart::where("product_id", $product->id)->first();
        if ($item) {
            $item->delete();
        }
         return redirect()->route("cart.index")->with("success", "Item removed successfully.");

    }
    public function update_item(Product $product, Request $request)
    {
        $item = Cart::where("product_id", $product->id)->first();
        if ($item) {
            $item->update([
                "quantity" => $request->input("quantity", 1),
            ]);
        }
    }
    public function clear_cart()
    {
        Cart::truncate();
        return redirect()->route("cart.index")->with("success", "Cart cleared successfully.");
    }
    public function checkout()
    {
        $cartItems = Cart::with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        Cart::truncate();
        dd("Checkout successful. Total amount: $" . $total);
        return redirect()->route("cart.index")->with("success", "Checkout successful.");
    }

}
