@extends('admin.layout.app')

@section('title', 'Crear Producto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Crear nuevo producto</h2>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-300 mb-2">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full bg-gray-700 border @error('name') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('name') true @enderror"
                    aria-errormessage="name-error"
                >
                @error('name')
                    <div id="name-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-300 mb-2">Precio</label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    class="w-full bg-gray-700 border @error('price') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('price') true @enderror"
                    aria-errormessage="price-error"
                >
                @error('price')
                    <div id="price-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_file" class="block text-gray-300 mb-2">Imagen</label>
                <input
                    type="file"
                    id="image_file"
                    name="image_file"
                    accept="image/*"
                    class="w-full bg-gray-700 border @error('image_file') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('image_file') true @enderror"
                    aria-errormessage="image-file-error"
                >
                  <small class="text-gray-500">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</small>
                @error('image_file')
                    <div id="image-file-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="description" class="block text-gray-300 mb-2">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full bg-gray-700 border @error('description') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('description') true @enderror"
                    aria-errormessage="description-error"
                >{{ old('description') }}</textarea>
                @error('description')
                    <div id="description-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender_id" class="block text-gray-300 mb-2">Género</label>
                <select
                    id="gender_id"
                    name="gender_id"
                    class="w-full bg-gray-700 border @error('gender_id') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('gender_id') true @enderror"
                    aria-errormessage="gender-error"
                >
                    <option value="" disabled selected>Selecciona un género</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}" {{ old('gender_id') == $gender->id ? 'selected' : '' }}>
                            {{ $gender->name }}
                        </option>
                    @endforeach
                </select>
                @error('gender_id')
                    <div id="gender-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="platform_id" class="block text-gray-300 mb-2">Plataforma</label>
                <select
                    id="platform_id"
                    name="platform_id"
                    class="w-full bg-gray-700 border @error('platform_id') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('platform_id') true @enderror"
                    aria-errormessage="platform-error"
                >
                    <option value="" disabled selected>Selecciona una plataforma</option>
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}" {{ old('platform_id') == $platform->id ? 'selected' : '' }}>
                            {{ $platform->name }}
                        </option>
                    @endforeach
                </select>
                @error('platform_id')
                    <div id="platform-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    Guardar producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
