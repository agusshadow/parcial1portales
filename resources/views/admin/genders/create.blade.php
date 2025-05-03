@extends('admin.layout.app')

@section('title', 'Crear Género')

@section('content')
<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Género</h2>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.genders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-300 mb-2">Nombre</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="w-full bg-gray-700 border @error('name') border-red-500 @else border-gray-600 @enderror rounded py-2 px-3 text-white focus:outline-none focus:border-blue-500"
                    aria-invalid="@error('name') true @enderror"
                    aria-errormessage="name-error"
                >

                @error('name')
                    <div id="name-error" class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                    Crear Género
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
