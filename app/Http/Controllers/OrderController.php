<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador para la gestión de órdenes
 *
 * Este controlador maneja todas las operaciones relacionadas con las órdenes
 * de compra, incluyendo la visualización de historial de pedidos, detalles
 * específicos y la gestión de estados como cancelaciones.
 */
class OrderController extends Controller
{
    /**
     * Muestra una lista de las órdenes del usuario actual
     *
     * Recupera todas las órdenes asociadas al usuario autenticado
     * ordenadas cronológicamente de más reciente a más antigua.
     *
     * @return \Illuminate\View\View Vista con el listado de órdenes
     */
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Muestra los detalles de una orden específica
     *
     * Recupera información detallada de una orden incluyendo los productos
     * asociados. Verifica que el usuario actual sea el propietario de la orden.
     *
     * @param int $id ID de la orden a mostrar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Vista con detalles o redirección si no tiene permiso
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si la orden no existe
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
     *
     * Presenta una confirmación visual de que la orden se ha procesado correctamente,
     * verificando que el usuario actual sea el propietario de la orden.
     *
     * @param \App\Models\Order $order Instancia de la orden completada
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Vista de agradecimiento o redirección si no tiene permiso
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
     *
     * Verifica que el usuario sea propietario de la orden y que el estado
     * sea "pendiente" para permitir la cancelación.
     *
     * @param int $id ID de la orden a cancelar
     * @return \Illuminate\Http\RedirectResponse Redirección a los detalles de la orden con mensaje de resultado
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si la orden no existe
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
