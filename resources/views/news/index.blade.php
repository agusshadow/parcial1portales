@extends('layout.app')

@section('title', 'Noticias')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Noticias y novedades</h1>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                @if($item->images)
                    <img src="{{ asset('storage/' . $item->images) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-500">Sin imagen</span>
                    </div>
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $item->title }}</h2>
                    <p class="text-gray-400 mb-4">{{ Str::limit($item->content, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('news.show', $item->id) }}" class="text-blue-500 hover:text-blue-400">
                            Leer más →
                        </a>
                        <span class="text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-400">{{ $item->created_at->format('d/m/Y') }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('news.show', $item->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm transition">
                                Leer
                            </a>
                            
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('news.edit', $item->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm transition">
                                        Editar
                                    </a>
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de querer eliminar esta noticia?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-8 bg-gray-800 rounded-lg">
                <p>No hay noticias disponibles.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
