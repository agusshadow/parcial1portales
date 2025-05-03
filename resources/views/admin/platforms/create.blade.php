@extends('admin.layout.app')

@section('title', 'Crear Plataforma')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-8">Crear Nueva Plataforma</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p class="font-bold">Por favor corrige los siguientes errores:</p>
            </div>
        @endif

        <form action="{{ route('admin.platforms.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Nombre</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="w-full px-3 py-2 border rounded-md @error('name') border-red-500 @enderror"
                    aria-invalid="@error('name') true @enderror"
                    aria-errormessage="name-error"
                >
                
                @error('name')
                    <div id="name-error" class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mt-6">
                <button type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                    Guardar Plataforma
                </button>
                
                <a href="{{ route('admin.platforms.index') }}" 
                   class="ml-2 text-gray-400 hover:text-gray-500 font-semibold px-4 py-2 rounded-md transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
