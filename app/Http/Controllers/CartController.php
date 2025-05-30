<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Muestra el carrito del usuario actual
     */
    public function index()
    {
        // Obtener el carrito del usuario o crear uno nuevo si no existe
        $cart = $this->getCart();
        
        return view('cart.index', compact('cart'));
    }
    
    /**
     * Añade un producto al carrito
     */
    public function add(Request $request, $productId)
    {
        // Validar la solicitud
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);
        
        // Buscar el producto
        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);
        
        // Obtener o crear el carrito
        $cart = $this->getCart();
        
        // Verificar si el producto ya está en el carrito
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        
        if ($cartItem) {
            // Si ya existe, actualizar cantidad
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Si no existe, crear nuevo item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }
        
        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }
    
    /**
     * Actualiza la cantidad de un producto en el carrito
     */
    public function update(Request $request, $cartItemId)
    {
        // Validar la solicitud
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        // Buscar el item del carrito
        $cartItem = CartItem::findOrFail($cartItemId);
        
        // Verificar que el item pertenezca al carrito del usuario actual
        $this->checkCartItemOwnership($cartItem);
        
        // Actualizar la cantidad
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
        // Buscar el item del carrito
        $cartItem = CartItem::findOrFail($cartItemId);
        
        // Verificar que el item pertenezca al carrito del usuario actual
        $this->checkCartItemOwnership($cartItem);
        
        // Eliminar el item
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }
    
    /**
     * Vacía completamente el carrito
     */
    public function clear()
    {
        $cart = $this->getCart();
        
        // Eliminar todos los items del carrito
        $cart->items()->delete();
        
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }
    
    /**
     * Muestra la página de checkout
     */
    public function checkout()
    {
        $cart = $this->getCart();
        
        // Verificar que el carrito no esté vacío
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No puedes proceder al checkout con un carrito vacío');
        }
        
        return view('cart.checkout', compact('cart'));
    }
    
    /**
     * Método auxiliar para obtener o crear el carrito del usuario actual
     */
    private function getCart()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener usuario
            $user = Auth::user();
            
            // Buscar carrito activo del usuario
            $cart = $user->carts()->where('active', true)->first();
            
            // Si no existe, crear uno nuevo
            if (!$cart) {
                $cart = $user->carts()->create([
                    'active' => true
                ]);
            }
            
            return $cart;
        }
        
        // Si el usuario no está autenticado, redireccionar al login
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al carrito');
    }
    
    /**
     * Verifica que un item de carrito pertenezca al usuario actual
     */
    private function checkCartItemOwnership($cartItem)
    {
        if ($cartItem->cart->user_id != Auth::id()) {
            abort(403, 'No tienes permiso para modificar este carrito');
        }
    }
}
