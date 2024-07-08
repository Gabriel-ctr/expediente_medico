<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Médicos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white dark:bg-gray-800">
                            <div class="text-center text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                                {{ ('Lista de Médicos') }}
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Lista de Médicos</h2>
                                <a href="{{ route('medicos.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md shadow-md">
                                    <i class="bi bi-plus-circle"></i> Añadir nuevo médico
                                </a>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombres</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Apellidos</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Especialidad</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teléfono</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($medicos as $medico)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->nombres }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->apellidos }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->especialidad }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->telefono }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medico->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('medicos.destroy', $medico->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('medicos.show', $medico->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded-md shadow-md"><i class="bi bi-eye"></i> Ver</a>

                                                    <a href="{{ route('medicos.edit', $medico->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md shadow-md"><i class="bi bi-pencil-square"></i> Editar</a>   

                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md shadow-md" onclick="return confirm('¿Deseas eliminar este médico?');"><i class="bi bi-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-red-500">
                                                <strong>No se encontraron médicos.</strong>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6">
                                {{ $medicos->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
