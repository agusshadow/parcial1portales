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
                <h1 class="text-4xl font-extrabold mb-4">{{ $product->name }}</h1>
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

                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md transition font-semibold">
                    Añadir al carrito
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
