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
        // Verifica se o item já existe no carrinho
        $cartItem = Cart::where("product_id", $product->id)->first();

        if ($cartItem) {
            // Se existir, atualiza a quantidade
            $cartItem->quantity += $request->input('quantity', 1); // Adiciona 1 se a quantidade não for especificada
            $cartItem->save();
        } else {
            // Se não existir, cria um novo item no carrinho
            Cart::create([
                "product_id" => $product->id,
                "quantity" => $request->input('quantity', 1), // Adiciona 1 se a quantidade não for especificada
            ]);
        }

        return redirect()->route("cart.index")->with("success", "Item adicionado/atualizado no carrinho com sucesso.");
    }

    public function remove_item(Product $product, Request $request)
    {
        $item = Cart::where("product_id", $product->id)->first();
        if ($item) {
            $item->delete();
            return redirect()->route("cart.index")->with("success", "Item removido com sucesso.");
        }
        return redirect()->route("cart.index")->with("error", "Item não encontrado no carrinho.");
    }

    public function update_item(Product $product, Request $request)
    {
        $item = Cart::where("product_id", $product->id)->first();
        if ($item) {
            $item->update([
                "quantity" => $request->input("quantity"), // Não precisa de default 1 aqui, pois o input já tem min="1"
            ]);
            return redirect()->route("cart.index")->with("success", "Quantidade atualizada com sucesso.");
        }
        return redirect()->route("cart.index")->with("error", "Item não encontrado no carrinho para atualização.");
    }

    public function clear_cart()
    {
        Cart::truncate();
        return redirect()->route("cart.index")->with("success", "Carrinho limpo com sucesso.");
    }

    public function checkout(Request $request)
    {
        if (Cart::count() == 0) {
            return redirect()->route("cart.index")->with("error", "Seu carrinho está vazio.");
        }

        $paymentMethod = $request->input('paymentMethod');
        $cartItems = Cart::with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $recipt = Recipt::create([
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

        return redirect()->route("recipts.generate", ['recipt' => $recipt->id])
            ->with("success", "Compra finalizada com sucesso! Seu recibo foi gerado.");
    }
}
