<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Controlador administrativo para la gestión de órdenes
 * 
 * Este controlador maneja todas las operaciones administrativas relacionadas
 * con las órdenes de compra, incluyendo visualización del listado completo,
 * detalles de órdenes específicas y la actualización de estados.
 */
class OrderController extends Controller
{
    /**
     * Muestra un listado de todas las órdenes en el panel administrativo
     * 
     * Recupera todas las órdenes del sistema ordenadas por fecha
     * de más reciente a más antigua, con paginación para facilitar la navegación.
     * 
     * @return \Illuminate\View\View Vista con el listado de órdenes para administradores
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Muestra los detalles completos de una orden específica
     * 
     * Recupera información detallada de una orden incluyendo los productos,
     * el método de pago y los datos del usuario para su visualización en el
     * panel administrativo.
     * 
     * @param int $id ID de la orden a mostrar
     * @return \Illuminate\View\View Vista con los detalles completos de la orden
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si la orden no existe
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'payment', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Actualiza el estado de una orden
     * 
     * Permite a los administradores modificar el estado de una orden existente
     * (pendiente, en proceso, completada o cancelada) y registra el cambio
     * en la base de datos.
     * 
     * @param \Illuminate\Http\Request $request Solicitud con el nuevo estado
     * @param int $id ID de la orden a actualizar
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista de detalles con mensaje de confirmación
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si la orden no existe
     * @throws \Illuminate\Validation\ValidationException Si el estado proporcionado no es válido
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
