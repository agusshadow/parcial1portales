@extends('layout.app')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 brounded-lg">
    <h2 class="text-3xl font-bold mb-8 text-center">Editar producto</h2>

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-300 mb-1" for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="price">Precio</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="image">URL de la imagen</label>
            <input type="text" id="image" name="image" value="{{ old('image', $product->image) }}"
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="description">Descripción</label>
            <textarea id="description" name="description" rows="4" required
                      class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="gender_id">Género</label>
            <select id="gender_id" name="gender_id" required
                    class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
                <option value="" disabled>Selecciona un género</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" {{ $product->gender_id == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="platform_id">Plataforma</label>
            <select id="platform_id" name="platform_id" required
                    class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
                <option value="" disabled>Selecciona una plataforma</option>
                @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}" {{ $product->platform_id == $platform->id ? 'selected' : '' }}>
                        {{ $platform->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>
@endsection
