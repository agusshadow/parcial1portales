@extends('admin.layout.app')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 brounded-lg">
    <h2 class="text-3xl font-bold mb-8 text-center">Editar producto</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <strong>¡Atención!</strong> Hay errores en el formulario.
        </div>
    @endif

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        

        <div>
            <label class="block text-gray-300 mb-1" for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                   aria-invalid="@error('name') true @enderror" 
                   aria-errormessage="name-error">
            @error('name')
                <div id="name-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="price">Precio</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('price') border-red-500 @enderror"
                   aria-invalid="@error('price') true @enderror" 
                   aria-errormessage="price-error">
            @error('price')
                <div id="price-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="image">URL de la imagen</label>
            <input type="text" id="image" name="image" value="{{ $product->image }}"
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('image') border-red-500 @enderror"
                   aria-invalid="@error('image') true @enderror" 
                   aria-errormessage="image-error">
            @error('image')
                <div id="image-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="description">Descripción</label>
            <textarea id="description" name="description" rows="4" required
                      class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                      aria-invalid="@error('description') true @enderror" 
                      aria-errormessage="description-error">{{ $product->description }}</textarea>
            @error('description')
                <div id="description-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="gender_id">Género</label>
            <select id="gender_id" name="gender_id" required
                    class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('gender_id') border-red-500 @enderror"
                    aria-invalid="@error('gender_id') true @enderror" 
                    aria-errormessage="gender-error">
                <option value="" disabled>Selecciona un género</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" {{ $product->gender_id == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
            @error('gender_id')
                <div id="gender-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-gray-300 mb-1" for="platform_id">Plataforma</label>
            <select id="platform_id" name="platform_id" required
                    class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('platform_id') border-red-500 @enderror"
                    aria-invalid="@error('platform_id') true @enderror" 
                    aria-errormessage="platform-error">
                <option value="" disabled>Selecciona una plataforma</option>
                @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}" {{ $product->platform_id == $platform->id ? 'selected' : '' }}>
                        {{ $platform->name }}
                    </option>
                @endforeach
            </select>
            @error('platform_id')
                <div id="platform-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
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
