
@extends('layout.app')

@section('title', 'Perfil de usuario')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Perfil de usuario</h2>
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="mb-4">
            <p class="text-gray-300 mb-2"><span class="font-bold">Nombre:</span> {{ $user->name }}</p>
            <p class="text-gray-300 mb-6"><span class="font-bold">Email:</span> {{ $user->email }}</p>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('user.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">Editar datos</a>
            <a href="{{ route('user.password.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">Cambiar contraseña</a>
        </div>
    </div>
</div>
@endsection