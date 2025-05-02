@extends('admin.layout.app')

@section('title', 'Confirmar Eliminación')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-red-500">¿Estás seguro que deseas eliminar este producto?</h2>

    <div class="bg-gray-800 rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2 text-white">{{ $product->name }}</h3>
        <p class="text-gray-400">{{ $product->description }}</p>
        <p class="text-gray-400 mt-2">Precio: <strong>${{ $product->price }}</strong></p>
    </div>

    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="text-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-semibold px-6 py-2 rounded mr-4">
            Sí, eliminar
        </button>
        <a href="{{ route('products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">
            Cancelar
        </a>
    </form>
</div>
@endsection
