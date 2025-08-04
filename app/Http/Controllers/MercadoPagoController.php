<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Http\Controllers\Log;
use App\Http\Controllers\CartController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Mail;

class MercadoPagoController extends Controller
{
    public function createPreference()
    {
        try {
            $cart = Auth::user()->carts()
                ->with('items.product')
                ->where('active', true)
                ->firstOrFail();

            MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

            $preferenceClient = new PreferenceClient();

            $items = $cart->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => (float)$item->price,
                    'currency_id' => 'ARS'
                ];
            })->all();

            $preference = $preferenceClient->create([
                'items' => $items,
                // ⚠️ IMPORTANTE:
                // Mercado Pago necesita URLs HTTPS públicas para redirigir después del pago.
                // Como estamos en local, usá ngrok para exponer tu servidor:
                //
                //     ngrok http 8000
                //
                // Copiá la URL que te da y reemplazala acá abajo, dejando la parte de /mp en adelante como está
                'back_urls' => [
                    'success' => 'https://dc47ea0f61ad.ngrok-free.app/mp/success',
                    'failure' => 'https://dc47ea0f61ad.ngrok-free.app/mp/failure',
                    'pending' => 'https://dc47ea0f61ad.ngrok-free.app/mp/pending',
                ],
                'auto_return' => 'approved',
            ]);

            return $preference;

        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            dd('MPApiException', [
                'message' => $e->getMessage(),
                'status' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent(),
            ]);
        } catch (\Exception $e) {
            dd('General Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function success(Request $request)
    {
        $cartController = new \App\Http\Controllers\CartController();
        $cart = $cartController->getCart();

        if ($cart instanceof \Illuminate\Http\RedirectResponse) {
            return $cart; // Si no hay usuario logueado, redirige
        }

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        // Asumimos que el usuario está logueado, y nombre/email ya están en el formulario
        $user = Auth::user();

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . uniqid(),
            'status' => 'completed',
            'name' => $user->name,
            'email' => $user->email,
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'mercadopago',
            'total' => $cart->total,
            'status' => 'approved',
        ]);

        $cart->update(['active' => false]);
        $cart->items()->delete();

        if ($order->status === 'completed') {
            Mail::to($order->email)->send(new PaymentApproved($order));
        }

        return redirect()
            ->route('cart.thank-you', ['paymentMethod' => 'mercadopago'])
            ->with('success', 'Pago confirmado. ¡Gracias por tu compra!');
    }

    public function pending(Request $request)
    {
        return redirect()
            ->route('cart.thank-you', ['paymentMethod' => 'mercadopago'])
            ->with('success', 'Pago Pendiente. ¡Gracias por tu compra!');
    }

    public function failure(Request $request)
    {
        $cartController = new CartController();
        $cart = $cartController->getCart();

        // Si getCart() devuelve un redirect (usuario no logueado), devolvés eso directamente
        if ($cart instanceof \Illuminate\Http\RedirectResponse) {
            return $cart;
        }

        $preference = $this->createPreference();

        return redirect()->route('cart.checkout', compact('cart', 'preference'))->with('error', 'El pago fue rechazado o cancelado. Intenta nuevamente.');
    }

}
