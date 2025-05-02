<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Digital Games')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
   <header>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-lg font-semibold">Digital Games</a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-6">
                        <a href="{{ url('/') }}" class="hover:text-gray-300">Inicio</a>
                        <a href="{{ route('products.index') }}" class="hover:text-gray-300">Productos</a>
                        <a href="{{ route('news.index') }}" class="hover:text-gray-300">Noticias</a>

                        @auth
                            <div class="relative group">
                                <button class="hover:text-gray-300 focus:outline-none flex items-center space-x-1">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute right-0 top-10 w-48 bg-gray-800 rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 z-20">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:rounded-md">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ url('/login') }}" class="flex items-center space-x-2 hover:text-gray-300">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 1.8c-3 0-9 1.5-9 4.5v1.5h18v-1.5c0-3-6-4.5-9-4.5z"/>
                                </svg>
                                <span>Iniciar sesión</span>
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none"
                            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden hidden px-2 pt-2 pb-3 space-y-1" id="mobile-menu">
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">Inicio</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">Productos</a>
            <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">Noticias</a>

            @auth
                <div class="space-y-1 border-t border-gray-700 pt-2 mt-2">
                    <span class="block px-3 py-2 text-base font-medium text-gray-400">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-400 hover:bg-gray-800">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ url('/login') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 1.8c-3 0-9 1.5-9 4.5v1.5h18v-1.5c0-3-6-4.5-9-4.5z"/>
                    </svg>
                    <span>Iniciar sesión</span>
                </a>
            @endauth
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-xl font-bold mb-4">Digital Games</h3>
                    <p>Tu portal confiable de juegos digitales para todas las plataformas. Compra rápida, segura y al mejor precio.</p>
                </div>

                <div>
                    <h4 class="text-white text-lg font-semibold mb-3">Navegación</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Inicio</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Todos los juegos</a></li>
                        <li><a href="#" class="hover:text-white transition">Ofertas</a></li>
                        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white text-lg font-semibold mb-3">Síguenos</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Twitter</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Discord</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} Digital Games. Todos los derechos reservados.
            </div>
        </div>
    </footer>
</body>
</html>
