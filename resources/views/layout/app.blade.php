<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Tienda de Juegos')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-900 text-white">
    <header>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-lg font-semibold">Titulo</a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ url('/') }}" class="hover:text-gray-300">Inicio</a>
                        <a href="{{ url('/products') }}" class="hover:text-gray-300">Productos</a>
                        <a href="{{ url('/news') }}" class="hover:text-gray-300">Noticias</a>
                        <a href="{{ url('/login') }}" class="hover:text-gray-300">Iniciar sesion</a>
                        <a href="{{ url('/register') }}" class="hover:text-gray-300">Registrar</a>
                    </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
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
            <a href="{{ url('/productos') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">Productos</a>
            <a href="{{ url('/contacto') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800">Contacto</a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="text-center py-2">
        <span>Footer</span>
    </footer>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
