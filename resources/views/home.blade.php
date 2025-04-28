@extends('layout.app')

@section('title', 'Inicio')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8  sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8 xl:mt-20">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Tu portal de</span>
                            <span class="block text-indigo-500 xl:inline">juegos digitales</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Descubre los mejores títulos para todas las plataformas. Precios competitivos y activación instantánea.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    Explorar juegos
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-gray-800 hover:bg-gray-700 md:py-4 md:text-lg md:px-10">
                                    Ofertas especiales
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
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                <div class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                    <i class="fab fa-steam text-4xl mb-3"></i>
                    <span class=" font-medium">Steam</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                    <i class="fab fa-playstation text-4xl mb-3"></i>
                    <span class=" font-medium">PlayStation</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                    <i class="fab fa-xbox text-4xl mb-3"></i>
                    <span class=" font-medium">Xbox</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                    <i class="fas fa-gamepad text-4xl mb-3"></i>
                    <span class=" font-medium">Nintendo</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                    <i class="fas fa-desktop text-4xl mb-3"></i>
                    <span class=" font-medium">PC</span>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center mb-8">Juegos Destacados</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @for ($i = 1; $i <= 4; $i++)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img class="w-full h-48 object-cover" src="https://picsum.photos/seed/game{{ $i }}/600/400" alt="Game Cover">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold">Juego Ejemplo {{ $i }}</h3>
                            <span class="bg-indigo-600 px-2 py-1 rounded text-sm">-20%</span>
                        </div>
                        <div class="flex items-center mb-3">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="text-gray-400 ml-2">(120)</span>
                        </div>
                        <p class="text-gray-400 mb-3 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea dictumst.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-400 line-through text-sm">$59.99</span>
                                <span class=" font-bold ml-2">$47.99</span>
                            </div>
                            <button class="bg-indigo-600 hover:bg-indigo-700  px-3 py-1 rounded-md transition">Añadir</button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-block px-6 py-2 border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-md transition-colors duration-300">Ver todos los juegos</a>
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
