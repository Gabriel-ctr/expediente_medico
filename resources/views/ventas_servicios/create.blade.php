<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Venta de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('ventas_servicios.store') }}" method="POST" id="venta_servicio_form">
                        @csrf

                        <div class="mb-4">
                            <label for="fecha" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Fecha') }}</label>
                            <input type="date" id="fecha" name="fecha" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('fecha') border-red-500 @enderror" value="{{ old('fecha') }}" required>
                            @error('fecha')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="paciente_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Paciente') }}</label>
                            <select id="paciente_id" name="paciente_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('paciente_id') border-red-500 @enderror" required>
                                <option value="">Seleccione un paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Servicios') }}</label>
                            @foreach ($servicios as $servicio)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="servicio_{{ $servicio->id }}" name="servicios[]" value="{{ $servicio->id }}" class="mr-2 servicio-checkbox" data-precio="{{ $servicio->costo }}" {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}>
                                    <label for="servicio_{{ $servicio->id }}" class="text-gray-700 dark:text-gray-300">{{ $servicio->nombre }} - Precio: ${{ $servicio->costo }}</label>
                                    
                                </div>
                            @endforeach
                            @error('servicios')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Total') }}</label>
                            <input type="number" id="total" name="total" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('total') border-red-500 @enderror" value="{{ old('total') }}" readonly required>
                            @error('total')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md">{{ __('Crear Venta de Servicios') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.servicio-checkbox');
            const totalInput = document.getElementById('total');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let total = 0;
                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            total += parseFloat(checkbox.getAttribute('data-precio'));
                        }
                    });
                    totalInput.value = total.toFixed(2);
                });
            });
        });
    </script>
</x-app-layout>
