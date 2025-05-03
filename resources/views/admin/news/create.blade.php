@extends('admin.layout.app')

@section('title', 'Crear noticia')

@section('content')
<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-6">Crear nueva noticia</h2>

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

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-300 mb-2">Título</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="w-full bg-gray-700 border @error('title') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('title') true @enderror"
                    aria-errormessage="title-error"
                >
                @error('title')
                    <div id="title-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-300 mb-2">Contenido</label>
                <textarea
                    name="content"
                    id="content"
                    rows="6"
                    class="w-full bg-gray-700 border @error('content') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('content') true @enderror"
                    aria-errormessage="content-error"
                ></textarea>
                @error('content')
                    <div id="content-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_file" class="block text-gray-300 mb-2">Imagen</label>
                <input
                    type="file"
                    name="image_file"
                    id="image_file"
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

            <div class="mb-6">
                <label for="links" class="block text-gray-300 mb-2">Enlace externo</label>
                <input
                    type="text"
                    name="links"
                    id="links"
                    class="w-full bg-gray-700 border @error('links') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('links') true @enderror"
                    aria-errormessage="links-error"
                >
                <small class="text-gray-500">URL completa con http:// o https://</small>
                @error('links')
                    <div id="links-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    Guardar noticia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
