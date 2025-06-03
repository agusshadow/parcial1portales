<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Mostrar todas las órdenes
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Mostrar detalle de una orden
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'payment', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }


    /**
     * Actualizar status de la orden
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)
                         ->with('success', 'Estado de la orden actualizado correctamente');
    }
}
