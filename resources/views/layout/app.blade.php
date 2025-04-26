<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Tienda de Juegos')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- navbar -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- footer -->
    </footer>
</body>
</html>
