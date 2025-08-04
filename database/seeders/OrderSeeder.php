<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->where('email', 'user@example.com')->first();
        if (!$user) return;

        $products = DB::table('products')->take(2)->get();
        $total = $products->sum('price');

        $order1Id = DB::table('orders')->insertGetId([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . uniqid(),
            'status' => 'completed',
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id' => $order1Id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('payments')->insert([
            'order_id' => $order1Id,
            'payment_method' => 'transfer',
            'total' => $total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order2Id = DB::table('orders')->insertGetId([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . uniqid(),
            'status' => 'cancelled',
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id' => $order2Id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('payments')->insert([
            'order_id' => $order2Id,
            'payment_method' => 'transfer',
            'total' => $total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order3Id = DB::table('orders')->insertGetId([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . uniqid(),
            'status' => 'pending',
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id' => $order3Id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('payments')->insert([
            'order_id' => $order3Id,
            'payment_method' => 'transfer',
            'total' => $total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}