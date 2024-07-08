<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Consulta Médica') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('consultas.update', $consulta->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="fecha" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Fecha') }}</label>
                            <input id="fecha" type="date" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('fecha') border-red-500 @enderror text-black" name="fecha" value="{{ old('fecha', $consulta->fecha) }}" required>
                            @error('fecha')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="motivo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Motivo de la consulta') }}</label>
                            <input id="motivo" type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('motivo') border-red-500 @enderror text-black" name="motivo" value="{{ old('motivo', $consulta->motivo) }}" required>
                            @error('motivo')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="sintomas" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Síntomas') }}</label>
                            <textarea id="sintomas" name="sintomas" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('sintomas') border-red-500 @enderror text-black" rows="4">{{ old('sintomas', $consulta->sintomas) }}</textarea>
                            @error('sintomas')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="diagnostico" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Diagnóstico') }}</label>
                            <textarea id="diagnostico" name="diagnostico" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('diagnostico') border-red-500 @enderror text-black" rows="4">{{ old('diagnostico', $consulta->diagnostico) }}</textarea>
                            @error('diagnostico')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="tratamiento" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Tratamiento') }}</label>
                            <textarea id="tratamiento" name="tratamiento" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('tratamiento') border-red-500 @enderror text-black" rows="4">{{ old('tratamiento', $consulta->tratamiento) }}</textarea>
                            @error('tratamiento')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="urgente" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Urgente') }}</label>
                            <select id="urgente" name="urgente" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('urgente') border-red-500 @enderror text-black">
                                <option value="0" @if ($consulta->urgente == 0) selected @endif>No</option>
                                <option value="1" @if ($consulta->urgente == 1) selected @endif>Sí</option>
                            </select>
                            @error('urgente')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="paciente_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Paciente') }}</label>
                            <select id="paciente_id" name="paciente_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('paciente') border-red-500 @enderror text-black">
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" @if ($consulta->paciente_id == $paciente->id) selected @endif>{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="medico_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Médico') }}</label>
                            <select id="medico_id" name="medico_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('medico_id') border-red-500 @enderror text-black">
                                <option value="">Seleccionar médico</option>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" @if ($consulta->medico_id == $medico->id) selected @endif>{{ $medico->nombres }}</option>
                                @endforeach
                            </select>
                            @error('medico_id')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="presion_arterial" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Presión Arterial') }}</label>
                            <input id="presion_arterial" type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('presion_arterial') border-red-500 @enderror text-black" name="presion_arterial" value="{{ old('presion_arterial', $consulta->presion_arterial) }}">
                            @error('presion_arterial')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="temperatura" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Temperatura') }}</label>
                            <input id="temperatura" type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('temperatura') border-red-500 @enderror text-black" name="temperatura" value="{{ old('temperatura', $consulta->temperatura) }}">
                            @error('temperatura')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="peso" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Peso') }}</label>
                            <input id="peso" type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('peso') border-red-500 @enderror text-black" name="peso" value="{{ old('peso', $consulta->peso) }}">
                            @error('peso')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="altura" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Altura') }}</label>
                            <input id="altura" type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('altura') border-red-500 @enderror text-black" name="altura" value="{{ old('altura', $consulta->altura) }}">
                            @error('altura')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="notas" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Notas adicionales') }}</label>
                            <textarea id="notas" name="notas" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('notas') border-red-500 @enderror text-black" rows="4">{{ old('notas', $consulta->notas) }}</textarea>
                            @error('notas')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="total" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Total') }}</label>
                            <input id="total" type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('total') border-red-500 @enderror text-black" name="total" value="{{ old('total', $consulta->total) }}">
                            @error('total')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer">{{ __('Guardar Cambios') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
