@extends('admin.layout.app')

@section('title', 'Orden #' . $order->order_number)

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Orden #{{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-indigo-400 hover:text-indigo-300">
            &larr; Volver a todas las órdenes
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Información de la Orden</h2>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-400">Fecha de orden</p>
                        <p class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Nombre</p>
                        <p class="font-medium">{{ $order->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Email</p>
                        <p class="font-medium">{{ $order->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Método de Pago</p>
                        <p class="font-medium">
                            @if($order->payment->payment_method == 'card')
                                Tarjeta de Crédito/Débito
                            @elseif($order->payment->payment_method == 'transfer')
                                Transferencia Bancaria
                            @elseif($order->payment->payment_method == 'mercadopago')
                                Mercado Pago
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Estado</p>
                        <p class="inline-block px-2 py-1 rounded-full text-xs font-medium
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
                        </p>

                        @if($order->status != 'cancelled' && $order->status != 'completed')
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mt-6">
                                @csrf
                                @method('PUT')

                                <label for="status" class="block text-sm text-gray-400 mb-2">Cambiar estado</label>
                                <select name="status" id="status" class="w-full bg-gray-700 text-white rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Procesando</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completado</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                </select>

                                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded text-white font-semibold transition">
                                    Actualizar estado
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>

            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Productos</h2>

                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex justify-between border-b border-gray-700 pb-4">
                            <div class="flex space-x-4">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                <div>
                                    <h3 class="font-medium">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                            <span class="font-medium">${{ number_format($item->quantity * $item->price, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <div class="bg-gray-800 rounded-lg p-6 sticky top-6">
                <h2 class="text-xl font-semibold mb-6">Resumen</h2>

                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Subtotal</span>
                        <span>${{ number_format($order->payment->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Descuento</span>
                        <span>$0.00</span>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-4 pt-4">
                    <div class="flex justify-between items-center font-bold text-lg">
                        <span>Total</span>
                        <span>${{ number_format($order->payment->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
