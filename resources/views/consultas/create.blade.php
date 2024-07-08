<x-app-layout>
    @vite('resources/css/app.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Consulta Médica') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('consultas.store') }}" method="post" class="space-y-4">
                        @csrf

                        <div>
                            <label for="fecha" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Fecha') }}</label>
                            <input type="date" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('fecha') border-red-500 @enderror text-black" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                            @error('fecha')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="motivo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Motivo de la consulta') }}</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo" value="{{ old('motivo') }}" placeholder="{{ __('Ingrese el motivo de la consulta') }}" required>
                            @error('motivo')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="sintomas" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Síntomas') }}</label>
                            <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('sintomas') border-red-500 @enderror" id="sintomas" name="sintomas" rows="4" placeholder="{{ __('Ingrese los síntomas del paciente') }}">{{ old('sintomas') }}</textarea>
                            @error('sintomas')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="diagnostico" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Diagnóstico') }}</label>
                            <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('diagnostico') border-red-500 @enderror" id="diagnostico" name="diagnostico" rows="4" placeholder="{{ __('Ingrese el diagnóstico') }}">{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="tratamiento" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Tratamiento') }}</label>
                            <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('tratamiento') border-red-500 @enderror" id="tratamiento" name="tratamiento" rows="4" placeholder="{{ __('Ingrese el tratamiento') }}">{{ old('tratamiento') }}</textarea>
                            @error('tratamiento')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="urgente" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Urgente') }}</label>
                            <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('urgente') border-red-500 @enderror text-black" id="urgente" name="urgente" required>
                                <option value="0" {{ old('urgente') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('urgente') == '1' ? 'selected' : '' }}>Sí</option>
                            </select>
                            @error('urgente')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="paciente_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Paciente') }}</label>
                            <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('paciente_id') border-red-500 @enderror text-black" id="paciente_id" name="paciente_id" required>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="medico_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Médico') }}</label>
                            <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('medico_id') border-red-500 @enderror text-black" id="medico_id" name="medico_id" required>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" {{ old('medico_id') == $medico->id ? 'selected' : '' }}>{{ $medico->nombre }}</option>
                                @endforeach
                            </select>
                            @error('medico_id')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="{{ __('Agregar Consulta') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
