<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function finalize()
    {
        $cart = Cart::with('items.product')->first(); // ou ->find($id) se você tiver o ID

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Carrinho está vazio ou não encontrado.');
        }

        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $pdf = Pdf::loadView('pdf.order', [
            'cart' => $cart,
            'items' => $cart->items,
            'total' => $total,
        ]);

        return $pdf->download('pedido.pdf');
    }
}
