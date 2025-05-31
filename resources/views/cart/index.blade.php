@extends('layout.app')

@section('title', 'Mi Carrito')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold mb-8">Mi Carrito</h1>

    @if($cart->items->isEmpty())
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
            
            @foreach($cart->items as $item)
                <div class="grid grid-cols-1 md:grid-cols-5 p-4 border-b border-gray-700 items-center">
                    <div class="md:col-span-2 flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                        <div>
                            <h3 class="font-medium">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-400">{{ $item->product->platform->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4 md:mt-0">
                        <span>${{ number_format($item->price, 2) }}</span>
                    </div>
                    
                    <div class="text-center mt-2 md:mt-0">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded-l">-</button>
                            <span class="px-4 py-1 bg-gray-900">{{ $item->quantity }}</span>
                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded-r">+</button>
                        </form>
                    </div>
                    
                    <div class="text-center mt-2 md:mt-0 flex items-center justify-center">
                        <span class="font-medium">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            
            <div class="p-4 bg-gray-900">
                <div class="flex justify-between items-center">
                    <span class="text-lg">Total:</span>
                    <span class="text-xl font-bold text-white">${{ number_format($cart->total, 2) }}</span>
                </div>
            </div>
            
            <div class="p-4 flex justify-between">
                <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md transition">
                    Seguir comprando
                </a>
                <div class="flex space-x-2">
                    <a href="{{ route('cart.clear') }}" class="px-6 py-2 bg-red-700 hover:bg-red-800 text-white rounded-md transition"
                       onclick="return confirm('¿Estás seguro de vaciar tu carrito?')">
                        Vaciar carrito
                    </a>
                    <a href="{{ route('cart.checkout') }}" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                        Proceder al pago
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection