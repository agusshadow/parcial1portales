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

        <div>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar por título"
                class="w-full sm:w-64 px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded"
            >
        </div>


        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                Buscar
            </button>

            @if(request('gender') || request('platform') || request('search'))
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
                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                    class="block bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300 hover:ring-2 hover:ring-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="my-4">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
