<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Muestra una lista de las órdenes del usuario actual
     */
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Muestra los detalles de una orden específica
     */
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')
                ->with('error', 'No tienes permiso para ver esta orden');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Muestra la página de agradecimiento después de completar una orden
     */
    public function thankYou(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')
                ->with('error', 'No tienes permiso para ver esta orden');
        }

        return view('orders.thank-you', compact('order'));
    }

    /**
     * Permite al usuario cancelar una orden (si está en estado pendiente)
     */
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')
                ->with('error', 'No tienes permiso para cancelar esta orden');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Solo puedes cancelar órdenes pendientes');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Tu orden ha sido cancelada');
    }
}
