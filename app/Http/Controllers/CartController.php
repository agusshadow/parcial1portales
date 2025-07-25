<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MercadoPagoController;

/**
 * Controlador para la gestión del carrito de compras
 *
 * Este controlador maneja todas las operaciones relacionadas con el carrito
 * de compras, incluyendo agregar productos, actualizar cantidades, eliminar items,
 * procesar órdenes y gestionar el proceso de checkout completo.
 */
class CartController extends Controller
{
    /**
     * Muestra el carrito del usuario actual
     *
     * Recupera el carrito activo asociado al usuario autenticado
     * y lo muestra con todos los productos agregados.
     *
     * @return \Illuminate\View\View Vista con el contenido del carrito
     */
    public function index()
    {
        $cart = $this->getCart();

        return view('cart.index', compact('cart'));
    }

    /**
     * Añade un producto al carrito
     *
     * Agrega un producto al carrito del usuario o incrementa su cantidad
     * si ya existe en el carrito. Valida la cantidad ingresada.
     *
     * @param \Illuminate\Http\Request $request Solicitud con datos del formulario
     * @param int $productId ID del producto a añadir
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista del carrito
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el producto no existe
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
     *
     * Modifica la cantidad de un producto específico en el carrito.
     * Si la cantidad es cero, el producto se elimina del carrito.
     *
     * @param \Illuminate\Http\Request $request Solicitud con la nueva cantidad
     * @param int $cartItemId ID del item del carrito a actualizar
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista del carrito
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el item no existe
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
     *
     * Remueve completamente un item específico del carrito del usuario.
     *
     * @param int $cartItemId ID del item del carrito a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista del carrito
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el item no existe
     */
    public function remove($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Vacía completamente el carrito
     *
     * Elimina todos los items del carrito activo del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista del carrito
     */
    public function clear()
    {
        $cart = $this->getCart();

        $cart->items()->delete();

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }

    public function checkout()
    {
        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No puedes proceder al checkout con un carrito vacío');
        }

        // Obtener la preferencia desde MercadoPagoController
        $mercadoPagoController = new MercadoPagoController();
        $preference = $mercadoPagoController->createPreference();

        // Si hubo un error

        return view('cart.checkout', compact('cart', 'preference'));
    }

    /**
     * Procesa la orden y crea un registro
     *
     * Valida los datos del checkout, crea la orden con sus items correspondientes,
     * registra el método de pago y marca el carrito como inactivo una vez finalizada la operación.
     *
     * @param \Illuminate\Http\Request $request Solicitud con los datos del formulario de checkout
     * @return \Illuminate\Http\RedirectResponse Redirección a la página de agradecimiento
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

        $status = $request->payment_method === 'card' ? 'completed' : 'pending';

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . uniqid(),
            'status' => $status,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'total' => $cart->total
        ]);


        $cart->update(['active' => false]);
        $cart->items()->delete();

        if ($status === 'completed') {
            Mail::to($order->email)->send(new PaymentApproved($order));
        }

        return redirect()->route('cart.thank-you')
            ->with('success', 'Compra realizada con éxito');
    }

    /**
     * Método auxiliar para obtener o crear el carrito del usuario actual
     *
     * Busca el carrito activo del usuario autenticado o crea uno nuevo
     * si no existe. Redirige al login si el usuario no está autenticado.
     *
     * @return \App\Models\Cart|Illuminate\Http\RedirectResponse Carrito activo o redirección al login
     */
    public function getCart()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $cart = $user->carts()
                ->with('items.product')
                ->where('active', true)
                ->first();

            if (!$cart) {
                $cart = $user->carts()->create([
                    'active' => true
                ]);
            }

            return $cart;
        }

        return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al carrito');
    }

    /**
     * Muestra la página de agradecimiento tras completar una orden
     *
     * Presenta una confirmación visual al usuario de que su orden
     * ha sido procesada correctamente.
     *
     * @return \Illuminate\View\View Vista de agradecimiento
     */
    public function thankYou()
    {
        return view('cart.thank-you');
    }
}
