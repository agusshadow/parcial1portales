@extends('layout.app')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 brounded-lg">
    <h2 class="text-3xl font-bold mb-8 text-center">Editar producto</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
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

        @if($product->image)
        <div>
            <label class="block text-gray-300 mb-1">Imagen actual</label>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 object-cover rounded mb-2">
        </div>
        @endif

        <div>
            <label class="block text-gray-300 mb-1" for="image_file">Cambiar imagen</label>
            <input type="file" id="image_file" name="image_file" accept="image/*"
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
            <p class="text-sm text-gray-400 mt-1">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB.</p>
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
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}" {{ old('gender_id', $product->gender_id) == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="platform_id">Plataforma</label>
            <select id="platform_id" name="platform_id" required
                    class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}" {{ old('platform_id', $product->platform_id) == $platform->id ? 'selected' : '' }}>
                        {{ $platform->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('products.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>
@endsection
