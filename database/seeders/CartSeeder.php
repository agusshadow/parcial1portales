<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->where('email', 'user@example.com')->first();
        if (!$user) return;

        $cartId = DB::table('carts')->insertGetId([
            'user_id' => $user->id,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $products = DB::table('products')->take(2)->get();
        foreach ($products as $product) {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
