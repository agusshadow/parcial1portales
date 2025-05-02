@extends('layout.app')

@section('title', 'Crear noticia')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('news.index') }}" class="text-blue-500 hover:text-blue-400">
            ← Volver a noticias
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Crear nueva noticia</h1>

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
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full bg-gray-700 border border-gray-600 rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="content" class="block text-gray-300 mb-2">Contenido</label>
                <textarea name="content" id="content" rows="6" 
                    class="w-full bg-gray-700 border border-gray-600 rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500">{{ old('content') }}</textarea>
            </div>
            
            <div class="mb-4">
                <label for="images" class="block text-gray-300 mb-2">Imagen</label>
                <input type="file" name="image_file" id="image_file" accept="image/*"
                    class="w-full bg-gray-700 border border-gray-600 rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500">
                <small class="text-gray-500">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</small>
            </div>
            
            <div class="mb-6">
                <label for="links" class="block text-gray-300 mb-2">Enlace externo</label>
                <input type="text" name="links" id="links" value="{{ old('links') }}" 
                    class="w-full bg-gray-700 border border-gray-600 rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500">
                <small class="text-gray-500">URL completa con http:// o https://</small>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Guardar noticia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection