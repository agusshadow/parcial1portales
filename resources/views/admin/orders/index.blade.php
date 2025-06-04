@extends('admin.layout.app')

@section('title', 'Órdenes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-8">Todas las Órdenes</h2>

        @if ($orders->isEmpty())
            <p class="text-center text-gray-300">No hay órdenes disponibles por el momento.</p>
        @else
            <div class="overflow-x-auto rounded-lg bg-gray-800">
                <table class="min-w-full table-auto text-sm text-white">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Número de Orden</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name ?? 'Usuario eliminado' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($order->status == 'completed') bg-green-600 bg-opacity-20 text-green-300
                                        @elseif($order->status == 'processing') bg-blue-600 bg-opacity-20 text-blue-300
                                        @elseif($order->status == 'cancelled') bg-red-600 bg-opacity-20 text-red-300
                                        @else bg-yellow-600 bg-opacity-20 text-yellow-300
                                        @endif">
                                        @if($order->status == 'completed') Completado
                                        @elseif($order->status == 'processing') Procesando
                                        @elseif($order->status == 'cancelled') Cancelado
                                        @else Pendiente
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="text-indigo-400 hover:text-indigo-300 mr-3">
                                       Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
