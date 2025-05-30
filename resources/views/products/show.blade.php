@extends('layout.app')

@section('title', $product->name)

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg shadow-md w-full h-auto object-cover">
            </div>

            <div>
                <h2 class="text-4xl font-extrabold mb-4">{{ $product->name }}</h2>
                <p class="text-gray-400 mb-4">{{ $product->description }}</p>

                <div class="mb-4">
                    <span class="block text-sm text-gray-500 uppercase tracking-wide">Plataforma</span>
                    <span class="text-indigo-400 font-medium">{{ $product->platform->name ?? 'N/A' }}</span>
                </div>

                <div class="mb-4">
                    <span class="block text-sm text-gray-500 uppercase tracking-wide">Género</span>
                    <span class="text-indigo-400 font-medium">{{ $product->gender->name ?? 'N/A' }}</span>
                </div>

                <div class="text-2xl font-bold text-indigo-500 mb-6">${{ $product->price }}</div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center mb-4">
                        <label for="quantity" class="block text-sm text-gray-500 mr-3">Cantidad:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" 
                               class="bg-gray-700 text-white border border-gray-600 rounded w-16 py-1 px-2">
                    </div>
                    
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md transition font-semibold">
                        Añadir al carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
