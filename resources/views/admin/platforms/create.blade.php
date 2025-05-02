@extends('admin.layout.app')

@section('title', 'Crear Plataforma')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 brounded-lg">
    <h2 class="text-3xl font-bold mb-8 text-center">Crear nueva plataforma</h2>

    <form action="{{ route('admin.platforms.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-300 mb-1" for="name">Nombre</label>
            <input type="text" id="name" name="name" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500">
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition">
                Guardar Plataforma
            </button>
        </div>
    </form>
</div>
@endsection
