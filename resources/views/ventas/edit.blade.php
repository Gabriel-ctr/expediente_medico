<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Venta') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="cliente" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Cliente') }}</label>
                            <input type="text" id="cliente" name="cliente" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('cliente') border-red-500 @enderror" value="{{ old('cliente', $venta->cliente) }}" required>
                            @error('cliente')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Medicamentos') }}</label>
                            @foreach ($medicamentos as $medicamento)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="medicamento_{{ $medicamento->id }}" name="medicamentos[]" value="{{ $medicamento->id }}" class="mr-2" {{ in_array($medicamento->id, $venta->medicamentos->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label for="medicamento_{{ $medicamento->id }}" class="text-gray-700 dark:text-gray-300">{{ $medicamento->nombre }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md">{{ __('Actualizar Venta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
