@extends('admin.layout.app')

@section('title', 'Editar Género')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 brounded-lg">
    <h2 class="text-3xl font-bold mb-8 text-center">Editar Género</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <strong>¡Atención!</strong> Hay errores en el formulario.
        </div>
    @endif

    <form action="{{ route('admin.genders.update', ['gender' => $gender->id]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-300 mb-1" for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ $gender->name }}" required
                   class="w-full px-4 py-2 rounded-md bg-gray-800 text-white focus:ring focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                   aria-invalid="@error('name') true @enderror" 
                   aria-errormessage="name-error">
            @error('name')
                <div id="name-error" class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md transition">
                Actualizar Género
            </button>
        </div>
    </form>
</div>
@endsection
