@extends('layout.app')

@section('title', 'Crear Cuenta')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-md mx-auto bg-gray-800 shadow-xl rounded-lg overflow-hidden">
        <div class="px-6 py-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white">Crear Cuenta</h2>
                <p class="mt-2 text-gray-400">Únete a nuestra comunidad de gamers</p>
            </div>
            
            @if ($errors->any())
                <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Nombre completo</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border @error('name') border-red-500 @else border-gray-600 @enderror rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        aria-invalid="@error('name') true @enderror" 
                        aria-errormessage="name-error"
                    >
                    @error('name')
                        <div id="name-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Correo electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border @error('email') border-red-500 @else border-gray-600 @enderror rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        aria-invalid="@error('email') true @enderror" 
                        aria-errormessage="email-error"
                    >
                    @error('email')
                        <div id="email-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border @error('password') border-red-500 @else border-gray-600 @enderror rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        aria-invalid="@error('password') true @enderror" 
                        aria-errormessage="password-error"
                    >
                    @error('password')
                        <div id="password-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar contraseña</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required 
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
                
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Crear cuenta
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400">
                    ¿Ya tienes cuenta?
                    <a href="/login" class="font-medium text-indigo-500 hover:text-indigo-400">Inicia sesión</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection