<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Mail;

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
     * Actualiza el estado de una orden específica.
     *
     * Valida que el nuevo estado esté dentro de los valores permitidos. 
     * Si el nuevo estado es 'completed', se envía un correo de confirmación al cliente.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP con los datos del nuevo estado.
     * @param int $id El ID de la orden a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista de detalles de la orden con un mensaje de éxito.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->input('status');
        $order->save();

        if ($order->status === 'completed') {
            Mail::to($order->email)->send(new PaymentApproved($order));
        }

        return redirect()->route('admin.orders.show', $order->id)
                         ->with('success', 'Estado de la orden actualizado correctamente');
    }
}
