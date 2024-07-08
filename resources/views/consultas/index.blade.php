<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultas') }}
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
                                {{ __('Lista de Consultas') }}
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Lista de Consultas') }}</h2>
                                <a href="{{ route('consultas.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md shadow-md">
                                    <i class="bi bi-plus-circle"></i> {{ __('Agregar Nueva Consulta') }}
                                </a>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('ID') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Fecha') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Motivo') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Síntomas') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Diagnóstico') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Tratamiento') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Urgente') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Paciente') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Médico') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Total') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Acciones') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($consultas as $consulta)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->fecha }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->motivo }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->sintomas }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->diagnostico }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->tratamiento }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->urgente ? 'Sí' : 'No' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->paciente->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->medico ? $consulta->medico->nombres : 'No asignado' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->total }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('consultas.edit', $consulta->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md shadow-md">
                                                    <i class="bi bi-pencil-square"></i> {{ __('Editar') }}
                                                </a>
                                                <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md shadow-md" onclick="return confirm('¿Estás seguro de eliminar esta consulta?')">
                                                        <i class="bi bi-trash"></i> {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ __('No hay consultas registradas.') }}
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
