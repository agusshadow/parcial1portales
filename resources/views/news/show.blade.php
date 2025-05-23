@extends('layout.app')

@section('title', $news->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        @if($news->images)
            <img src="{{ asset('storage/' . $news->images) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover">
        @endif

        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $news->title }}</h2>
            <div class="text-gray-400 mb-2">
                <span>Publicado el {{ $news->created_at->format('d/m/Y') }}</span>
            </div>

            <div class="mt-6 space-y-4 text-gray-300">
                {!! nl2br(e($news->content)) !!}
            </div>

            @if($news->links)
            <div class="mt-8">
                <a href="{{ $news->links }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded inline-flex items-center">
                    <span>Más información</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
