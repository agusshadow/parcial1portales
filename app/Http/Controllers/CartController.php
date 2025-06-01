<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Muestra el carrito del usuario actual
     */
    public function index()
    {
        $cart = $this->getCart();

        return view('cart.index', compact('cart'));
    }

    /**
     * Añade un producto al carrito
     */
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);

        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito');
    }

    /**
     * Actualiza la cantidad de un producto en el carrito
     */
    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        if ($request->quantity == 0) {
            return $this->remove($cartItemId);
        }
        $cartItem = CartItem::findOrFail($cartItemId);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);


        return redirect()->route('cart.index')->with('success', 'Carrito actualizado');
    }

    /**
     * Elimina un producto del carrito
     */
    public function remove($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Vacía completamente el carrito
     */
    public function clear()
    {
        $cart = $this->getCart();

        $cart->items()->delete();

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }

    /**
     * Muestra la página de checkout
     */
    public function checkout()
    {
        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No puedes proceder al checkout con un carrito vacío');
        }

        return view('cart.checkout', compact('cart'));
    }

    /**
     * Procesa la orden y crea un registro
     */
    public function processOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|in:card,transfer'
        ]);

        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . uniqid(),
            'total' => $cart->total,
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'payment_method' => $request->payment_method
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        if ($request->payment_method == 'card') {
            $order->update(['status' => 'processing']);
        }

        $cart->update(['active' => false]);

        $cart->items()->delete();

        return redirect()->route('cart.thank-you')
            ->with('success', 'Compra realizada con exito');
    }

    /**
     * Método auxiliar para obtener o crear el carrito del usuario actual
     */
    private function getCart()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $cart = $user->carts()->where('active', true)->first();

            if (!$cart) {
                $cart = $user->carts()->create([
                    'active' => true
                ]);
            }

            return $cart;
        }

        return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al carrito');
    }

    public function thankYou()
    {
        return view('cart.thank-you');
    }

}
