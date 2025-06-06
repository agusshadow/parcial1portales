@extends('admin.layout.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8">Panel de Administración</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold">Productos</h2>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 mb-6">Administra los productos de la tienda: agrega, edita y elimina juegos.</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                            Crear
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            Ver todos
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold">Noticias</h2>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 mb-6">Gestiona las noticias y actualizaciones de la tienda.</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.news.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                            Crear
                        </a>
                        <a href="{{ route('admin.news.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            Ver todas
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold">Plataformas</h2>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 mb-6">Gestiona las plataformas disponibles para los productos.</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.platforms.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                            Crear
                        </a>
                        <a href="{{ route('admin.platforms.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            Ver todas
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold">Géneros</h2>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 mb-6">Administra los géneros para clasificar los productos.</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.genders.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                            Crear
                        </a>
                        <a href="{{ route('admin.genders.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            Ver todos
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-12">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Usuarios</h2>
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.992 4.992 0 011 14V7a4 4 0 014-4h14a4 4 0 014 4v7a4.992 4.992 0 01-4.121 4.804M12 12a4 4 0 100-8 4 4 0 000 8zM6 20h12a2 2 0 002-2v-2a6 6 0 00-6-6H10a6 6 0 00-6 6v2a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-400 mb-6">Consulta y gestiona los usuarios registrados en la tienda.</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                        Crear
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                        Ver todos
                    </a>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-12">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold">Ordenes</h2>
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h14M3 6h18M3 14h14m4 4H5a2 2 0 01-2-2V7a2 2 0 012-2h16a2 2 0 012 2v9a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <p class="text-gray-400 mb-6">Consulta las ordenes creadas por los usuarios.</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                    Ver todas
                </a>
            </div>
        </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Estadísticas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Productos</p>
                            <p class="text-2xl font-bold">{{ \App\Models\Product::count() }}</p>
                        </div>
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Noticias</p>
                            <p class="text-2xl font-bold">{{ \App\Models\News::count() }}</p>
                        </div>
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Plataformas</p>
                            <p class="text-2xl font-bold">{{ \App\Models\Platform::count() }}</p>
                        </div>
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Géneros</p>
                            <p class="text-2xl font-bold">{{ \App\Models\Gender::count() }}</p>
                        </div>
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Usuarios</p>
                            <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                        </div>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.992 4.992 0 011 14V7a4 4 0 014-4h14a4 4 0 014 4v7a4.992 4.992 0 01-4.121 4.804M12 12a4 4 0 100-8 4 4 0 000 8zM6 20h12a2 2 0 002-2v-2a6 6 0 00-6-6H10a6 6 0 00-6 6v2a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Ordenes</p>
                            <p class="text-2xl font-bold">{{ \App\Models\Order::count() }}</p>
                        </div>
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h14M3 6h18M3 14h14m4 4H5a2 2 0 01-2-2V7a2 2 0 012-2h16a2 2 0 012 2v9a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
