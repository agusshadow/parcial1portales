@extends('layout.app')

@section('title', 'Inicio')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8 xl:mt-20">
                    <div class="sm:text-center lg:text-left">
                        <h2 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Tu portal de</span>
                            <span class="block text-indigo-500 xl:inline">juegos digitales</span>
                        </h2>
                        <p class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Descubre los mejores títulos para todas las plataformas. Precios competitivos y activación instantánea.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('products.index') }}"  class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    Explorar juegos
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover rounded-md sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Gaming setup">
        </div>
    </div>

    <div class="bg-gray-800 py-12 my-8 rounded-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center mb-8">Plataformas disponibles</h2>
            @if($platforms->isEmpty())
                <p class="text-center text-gray-400">No hay plataformas registradas.</p>
            @else
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                    @foreach($platforms as $platform)
                        <a
                            href="{{ route('products.index', ['platform' => $platform->id]) }}"
                            class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300"
                        >
                            <span class="font-medium">{{ $platform->name }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center mb-8">Juegos Destacados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                 @foreach ($products as $product)
                    <a href="{{ route('products.show', ['product' => $product->id]) }}"
                    class="block bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300 hover:ring-2 hover:ring-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-1">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 80) }}</p>
                            <div class="text-sm text-gray-300 mb-1">
                                <strong>Género:</strong> {{ $product->gender->name ?? 'N/A' }}
                            </div>
                            <div class="text-sm text-gray-300 mb-2">
                                <strong>Plataforma:</strong> {{ $product->platform->name ?? 'N/A' }}
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-lg font-bold text-indigo-500">${{ $product->price }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-block px-6 py-2 border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-md transition-colors duration-300">Ver todos los juegos</a>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-800 rounded-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold">Ofertas Especiales</h2>
                <p class="mt-2 text-gray-400">¡Aprovecha nuestras ofertas por tiempo limitado!</p>
            </div>
            <div class="bg-indigo-800 rounded-lg shadow-xl p-6 md:p-8 lg:flex lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-2xl font-bold">¡OFERTA FLASH!</h3>
                    <p class="mt-2 text-indigo-200">Obtén un 30% de descuento en todos los juegos de acción</p>
                    <p class="mt-4 font-bold">Usa el código: <span class="bg-white text-indigo-800 px-2 py-1 rounded">ACTION30</span></p>
                </div>
                <div class="mt-6 lg:mt-0 lg:ml-6">
                    <p class="text-indigo-200">La oferta termina en:</p>
                    <div class="flex space-x-3 mt-2">
                        <div class="bg-indigo-900 p-2 rounded-md text-center w-16">
                            <span class="block text-2xl font-bold">24</span>
                            <span class="text-xs text-indigo-200">Horas</span>
                        </div>
                        <div class="bg-indigo-900 p-2 rounded-md text-center w-16">
                            <span class="block text-2xl font-bold">18</span>
                            <span class="text-xs text-indigo-200">Minutos</span>
                        </div>
                        <div class="bg-indigo-900 p-2 rounded-md text-center w-16">
                            <span class="block text-2xl font-bold">45</span>
                            <span class="text-xs text-indigo-200">Segundos</span>
                        </div>
                    </div>
                    <button class="mt-4 w-full px-4 py-2 bg-white text-indigo-800 font-bold rounded hover:bg-gray-100 transition">¡Aprovechar ahora!</button>
                </div>
            </div>
        </div>
    </div>
@endsection
