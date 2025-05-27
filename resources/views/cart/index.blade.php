@extends('layout.app')

@section('title', 'Mi Carrito')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold mb-8">Mi Carrito</h1>

    @if($products->isEmpty())
        <div class="bg-gray-800 rounded-lg p-6 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="text-lg">Tu carrito está vacío</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                Explorar juegos
            </a>
        </div>
    @else
        <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="hidden md:grid md:grid-cols-5 bg-gray-900 text-gray-400 text-sm uppercase font-semibold p-4">
                <div class="md:col-span-2">Producto</div>
                <div class="text-center">Precio</div>
                <div class="text-center">Cantidad</div>
                <div class="text-center">Total</div>
            </div>
            
            @php $total = 0; @endphp
            
            @foreach($products as $product)
                @php 
                    $quantity = 1; // Mock: para simular una cantidad
                    $itemTotal = $product->price * $quantity;
                    $total += $itemTotal;
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-5 p-4 border-b border-gray-700 items-center">
                    <div class="md:col-span-2 flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        <div>
                            <h3 class="font-medium">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-400">{{ $product->platform->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4 md:mt-0">
                        <span>${{ $product->price }}</span>
                    </div>
                    
                    <div class="text-center mt-2 md:mt-0">
                        <div class="inline-flex items-center">
                            <button class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded-l">-</button>
                            <span class="px-4 py-1 bg-gray-900">{{ $quantity }}</span>
                            <button class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded-r">+</button>
                        </div>
                    </div>
                    
                    <div class="text-center mt-2 md:mt-0">
                        <span class="font-medium">${{ number_format($itemTotal, 2) }}</span>
                    </div>
                </div>
            @endforeach
            
            <div class="p-4 bg-gray-900">
                <div class="flex justify-between items-center">
                    <span class="text-lg">Total:</span>
                    <span class="text-xl font-bold text-white">${{ number_format($total, 2) }}</span>
                </div>
            </div>
            
            <div class="p-4 flex justify-between">
                <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md transition">
                    Seguir comprando
                </a>
                <a href="{{ route('cart.checkout') }}" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                    Proceder al pago
                </a>
            </div>
        </div>
    @endif
</div>
@endsection