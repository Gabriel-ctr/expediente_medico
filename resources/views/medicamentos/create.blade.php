<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Medicamento') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('medicamentos.store') }}" method="post" class="space-y-4">
                        @csrf

                        <div>
                            <label for="nombre" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Nombre') }}</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('nombre') border-red-500 @enderror text-black" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="{{ __('Ingrese el nombre del medicamento') }}" required>
                            @error('nombre')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="cantidad" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Cantidad') }}</label>
                            <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('cantidad') border-red-500 @enderror text-black" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" placeholder="{{ __('Ingrese la cantidad del medicamento') }}" required>
                            @error('cantidad')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="precio" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Precio por Unidad') }}</label>
                            <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('precio') border-red-500 @enderror text-black" id="precio" name="precio" value="{{ old('precio') }}" placeholder="{{ __('Ingrese el precio por unidad del medicamento') }}" required>
                            @error('precio')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="{{ __('Agregar Medicamento') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
