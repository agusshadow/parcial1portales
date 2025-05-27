@extends('layout.app')

@section('title', 'Productos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold mb-8">Todos los Productos</h2>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="mb-8 flex flex-col sm:flex-row gap-4">
        <div>
            <select name="gender" class="w-full sm:w-48 px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded">
                <option value="">Género</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" {{ request('gender') == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <select name="platform" class="w-full sm:w-48 px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded">
                <option value="">Plataforma</option>
                @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}" {{ request('platform') == $platform->id ? 'selected' : '' }}>
                        {{ $platform->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                Filtrar
            </button>

            @if(request('gender') || request('platform'))
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded">
                    Quitar filtros
                </a>
            @endif
        </div>
    </form>

    @if ($products->isEmpty())
        <p class="text-center text-gray-400">No hay productos disponibles por el momento.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="hover:text-indigo-400">
                            <h3 class="text-xl font-bold mb-1">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 80) }}</p>
                        <div class="text-sm text-gray-300 mb-1">
                            <strong>Género:</strong> {{ $product->gender->name ?? 'N/A' }}
                        </div>
                        <div class="text-sm text-gray-300 mb-2">
                            <strong>Plataforma:</strong> {{ $product->platform->name ?? 'N/A' }}
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-lg font-bold text-indigo-500">${{ $product->price }}</span>
                            
                            <button class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Añadir
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
