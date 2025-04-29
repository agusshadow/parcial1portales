@extends('layout.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto bg-gray-800 shadow-xl rounded-lg overflow-hidden">
        <div class="px-6 py-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-white">Iniciar Sesión</h1>
                <p class="mt-2 text-gray-400">Accede a tu cuenta para comprar juegos</p>
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
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Correo electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        class="mt-1 block w-full px-3 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
                
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Iniciar Sesión
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400">
                    ¿No tienes cuenta?
                    <a href="/register" class="font-medium text-indigo-500 hover:text-indigo-400">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
