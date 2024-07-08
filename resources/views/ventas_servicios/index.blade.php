<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ventas de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ __('Lista de Ventas de Servicios') }}</h3>
                        <a href="{{ route('ventas_servicios.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md">{{ __('Nueva Venta de Servicios') }}</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">{{ __('Fecha') }}</th>
                                    <th class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">{{ __('Total') }}</th>
                                    <th class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventasServicios as $ventaServicio)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                        <td class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">{{ $ventaServicio->fecha }}</td>
                                        <td class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">${{ $ventaServicio->total }}</td>
                                        <td class="py-2 px-3 border-b border-gray-300 dark:border-gray-600">
                                            <a href="{{ route('ventas_servicios.edit', $ventaServicio->id) }}" class="text-yellow-500 hover:text-yellow-600 mr-2">{{ __('Editar') }}</a>
                                            <form action="{{ route('ventas_servicios.destroy', $ventaServicio->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600">{{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $ventasServicios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
