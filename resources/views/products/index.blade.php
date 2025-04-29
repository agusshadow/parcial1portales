@extends('layout.app')

@section('title', 'Productos')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-center mb-8">Todos los Productos</h2>

        @if ($products->isEmpty())
            <p class="text-center text-gray-400">No hay productos disponibles por el momento.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-1">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 80) }}</p>
                            <div class="text-sm text-gray-300 mb-1">
                                <strong>Género:</strong> {{ $product->gender->name ?? 'N/A' }}
                            </div>
                            <div class="text-sm text-gray-300 mb-2">
                                <strong>Plataforma:</strong> {{ $product->platform->name ?? 'N/A' }}
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-lg font-bold text-indigo-500">${{ $product->price }}</span>
                                <a
                                    href="{{ route('products.show', ['product' => $product->id]) }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm transition"
                                >Ver
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
