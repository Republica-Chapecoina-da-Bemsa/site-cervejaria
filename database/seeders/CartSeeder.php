<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $cart = Cart::factory()->create();

        CartItem::factory()
            ->count(5)
            ->for($cart)
            ->create();
    }
}
