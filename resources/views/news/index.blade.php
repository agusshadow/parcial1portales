@extends('layout.app')

@section('title', 'Noticias')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold mb-2">Noticias y Novedades</h1>
    </div>

    <p class="text-gray-400 text-lg mb-8">
        En esta sección te mantendremos informado sobre las últimas novedades, actualizaciones y noticias importantes.
    </p>

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
                        <a href="{{ route('news.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-700">
                            Leer más →
                        </a>
                        <span class="text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</span>
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
