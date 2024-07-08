<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Venta de Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
                        @csrf

                        <div class="mb-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Fecha') }}</label>
                            <input type="date" name="fecha" id="fecha" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-black">
                        </div>

                        <div class="mb-4">
                            <label for="paciente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Paciente') }}</label>
                            <select name="paciente_id" id="paciente_id" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-black">
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Medicamentos') }}</label>
                            @foreach($medicamentos as $medicamento)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" name="medicamentos[{{ $medicamento->id }}][id]" id="medicamento-{{ $medicamento->id }}" value="{{ $medicamento->id }}" class="mr-2 medicamento-checkbox" data-id="{{ $medicamento->id }}">
                                    <label for="medicamento-{{ $medicamento->id }}" class="text-gray-800 dark:text-gray-200">{{ $medicamento->nombre }}</label>
                                    <input type="number" name="medicamentos[{{ $medicamento->id }}][cantidad]" placeholder="Cantidad" class="ml-4 block w-24 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-black medicamento-cantidad" data-id="{{ $medicamento->id }}" disabled>
                                    <input type="number" name="medicamentos[{{ $medicamento->id }}][precio]" placeholder="Precio Unitario" step="0.01" class="ml-4 block w-32 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-black medicamento-precio" readonly data-id="{{ $medicamento->id }}" disabled value="{{ $medicamento->precio }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label for="total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Total') }}</label>
                            <input type="number" name="total" id="total" step="0.01" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-black" readonly>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md">
                                {{ __('Registrar Venta') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.medicamento-checkbox');
            const cantidades = document.querySelectorAll('.medicamento-cantidad');
            const precios = document.querySelectorAll('.medicamento-precio');
            const totalInput = document.getElementById('total');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const id = this.dataset.id;
                    const cantidadInput = document.querySelector(`.medicamento-cantidad[data-id='${id}']`);
                    const precioInput = document.querySelector(`.medicamento-precio[data-id='${id}']`);

                    if (this.checked) {
                        cantidadInput.disabled = false;
                        precioInput.disabled = false;
                    } else {
                        cantidadInput.disabled = true;
                        precioInput.disabled = true;
                        cantidadInput.value = '';
                        precioInput.value = '';
                    }

                    calculateTotal();
                });
            });

            cantidades.forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            precios.forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            function calculateTotal() {
                let total = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const id = checkbox.dataset.id;
                        const cantidad = parseFloat(document.querySelector(`.medicamento-cantidad[data-id='${id}']`).value) || 0;
                        const precio = parseFloat(document.querySelector(`.medicamento-precio[data-id='${id}']`).value) || 0;

                        total += cantidad * precio;
                    }
                });

                totalInput.value = total.toFixed(2);
            }
        });
    </script>
</x-app-layout>
