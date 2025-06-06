@extends('admin.layout.app')

@section('title', 'Usuarios')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-8">Usuarios Registrados</h2>

        <div class="my-6">
            <a href="{{ route('admin.users.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                + Crear nuevo
            </a>
        </div>

        @if ($users->isEmpty())
            <p class="text-center text-gray-300">No hay usuarios registrados por el momento.</p>
        @else
            <div class="overflow-x-auto rounded-lg bg-gray-800">
                <table class="min-w-full table-auto text-sm text-white">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role == 'admin')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Administrador
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Usuario
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-400 hover:text-yellow-300 mr-3">Editar</a>

                                    @if(auth()->id() !== $user->id)
                                        <a href="{{ route('admin.users.confirm-delete', $user->id) }}" class="text-red-400 hover:text-red-300">Eliminar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
