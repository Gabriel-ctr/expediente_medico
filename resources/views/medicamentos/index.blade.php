<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Medicamentos') }}
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
                                {{ __('Lista de Medicamentos') }}
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Lista de Medicamentos') }}</h2>
                                <a href="{{ route('medicamentos.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md shadow-md">
                                    <i class="bi bi-plus-circle"></i> {{ __('Añadir nuevo medicamento') }}
                                </a>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('ID') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Nombre') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Cantidad') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Precio por unidad') }}</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Acciones') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($medicamentos as $medicamento)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->cantidad }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->precio }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md shadow-md">
                                                        <i class="bi bi-pencil-square"></i> {{ __('Editar') }}
                                                    </a>   

                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md shadow-md">
                                                        <i class="bi bi-trash"></i> {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-red-500">
                                                <strong>{{ __('No se encontraron medicamentos.') }}</strong>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6">
                                {{ $medicamentos->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
