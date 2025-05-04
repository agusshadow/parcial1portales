@extends('admin.layout.app')

@section('title', 'Plataformas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-8">Todas las Plataformas</h2>

        @if ($platforms->isEmpty())
            <p class="text-center text-gray-300">No hay plataformas disponibles por el momento.</p>
        @else
            <div class="overflow-x-auto rounded-lg bg-gray-800">
                <table class="min-w-full table-auto text-sm text-white">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Cantidad de Productos</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach ($platforms as $platform)
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $platform->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $platform->products_count ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.platforms.edit', $platform->id) }}" class="text-yellow-400 hover:text-yellow-300 mr-3">Editar</a>
                                    <a href="{{ route('admin.platforms.confirm-delete', $platform->id) }}" class="text-red-400 hover:text-red-300">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.platforms.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                    + Crear nueva
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
