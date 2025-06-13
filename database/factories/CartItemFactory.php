<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = \App\Models\CartItem::class;

    public function definition()
    {
        return [
            'cart_id' => Cart::factory(),
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
        ];
    }
}
