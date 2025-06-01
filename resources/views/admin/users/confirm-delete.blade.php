@extends('admin.layout.app')

@section('title', 'Confirmar Eliminación')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-red-500">¿Estás seguro que deseas eliminar este usuario?</h2>

    <div class="bg-gray-800 rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2 text-white">{{ $user->name }}</h3>
        <p class="text-gray-400">{{ $user->email }}</p>
        <p class="text-gray-400 mt-1">Rol: <span class="capitalize">{{ $user->role }}</span></p>
    </div>

    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="text-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-semibold px-6 py-2 rounded mr-4">
            Sí, eliminar
        </button>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">
            Cancelar
        </a>
    </form>
</div>
@endsection
