@extends('layout.app')

@section('title', 'Mis Órdenes')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold mb-8">Mis Órdenes</h1>

    @if($orders->isEmpty())
        <div class="bg-gray-800 rounded-lg p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="text-lg text-gray-400 mb-4">Aún no tienes ninguna orden</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">
                Explorar productos
            </a>
        </div>
    @else
        <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="hidden md:grid md:grid-cols-5 bg-gray-900 text-gray-400 text-sm uppercase font-semibold p-4">
                <div>Orden #</div>
                <div>Fecha</div>
                <div>Estado</div>
                <div class="text-center">Total</div>
                <div class="text-center">Acciones</div>
            </div>

            @foreach($orders as $order)
                <div class="grid grid-cols-1 md:grid-cols-5 p-4 border-b border-gray-700 items-center hover:bg-gray-750 transition">
                    <div class="py-2 md:py-0">
                        <span class="md:hidden text-xs text-gray-500 block">Orden #:</span>
                        <span class="font-medium">{{ $order->order_number }}</span>
                    </div>

                    <div class="py-2 md:py-0">
                        <span class="md:hidden text-xs text-gray-500 block">Fecha:</span>
                        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="py-2 md:py-0">
                        <span class="md:hidden text-xs text-gray-500 block">Estado:</span>
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
                    </div>

                    <div class="py-2 md:py-0 text-right md:text-center">
                        <span class="md:hidden text-xs text-gray-500 block">Total:</span>
                        <span class="font-medium">${{ number_format($order->payment->total, 2) }}</span>
                    </div>

                    <div class="py-2 md:py-0 flex justify-start md:justify-center space-x-2">
                        <a href="{{ route('orders.show', $order) }}" class="inline-block px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition text-sm">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
