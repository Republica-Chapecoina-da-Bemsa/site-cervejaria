<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Recipt;
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
            "quantity" => $request->input('quantity'),
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
    public function checkout(Request $request)
    {
        if (Cart::count() == 0) {
            return redirect()->route("cart.index")->with("error", "Your cart is empty.");
        }
        $paymentMethod = $request->input('paymentMethod');
        $cartItems = Cart::with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        Recipt::create([
            'total_amount' => $total,
            'payment_method' => $paymentMethod,
            'status' => 'completed',
            'products' => json_encode($cartItems->map(function ($item) {
            return [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ];
            })->toArray()),
        ]);
        Cart::truncate();
        return redirect()->route("cart.index")->with("success", "Checkout successful.");
    }

}
