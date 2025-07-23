@extends('layout.app')

@section('title', 'Cambiar contraseña')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Cambiar contraseña</h2>
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
        <form method="POST" action="{{ route('user.password.change') }}">
            @csrf
            <div class="mb-4">
                <label for="current_password" class="block text-gray-300 mb-2">Contraseña actual</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="w-full bg-gray-700 border @error('current_password') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('current_password') true @enderror"
                    aria-errormessage="current-password-error"
                    required
                >
                @error('current_password')
                    <div id="current-password-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-300 mb-2">Nueva contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full bg-gray-700 border @error('password') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('password') true @enderror"
                    aria-errormessage="password-error"
                    required
                >
                @error('password')
                    <div id="password-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-300 mb-2">Confirmar nueva contraseña</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full bg-gray-700 border @error('password_confirmation') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('password_confirmation') true @enderror"
                    aria-errormessage="password-confirmation-error"
                    required
                >
                @error('password_confirmation')
                    <div id="password-confirmation-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    Cambiar contraseña
                </button>
                <a href="{{ route('user.profile') }}" class="ml-2 bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection