<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Muestra el carrito con productos de prueba
     */
    public function index()
    {
        $products = Product::take(3)->get();

        $cartItems = [];
        $total = 0;

        foreach ($products as $product) {
            $quantity = rand(1, 3);
            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }

        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'products' => $products
        ]);
    }

    /**
     * Muestra la página de checkout
     */
    public function checkout()
    {
        $products = Product::take(3)->get();

        $cartItems = [];
        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = rand(1, 2);
            $itemTotal = $product->price * $quantity;
            $subtotal += $itemTotal;

            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $itemTotal
            ];
        }

        $total = $subtotal;

        return view('cart.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    }
}
