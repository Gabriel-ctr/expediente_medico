<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Paciente') }}
        </h2>
    </x-slot>
    <div class="flex justify-center mt-8">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Editar paciente</h2>
                    <a href="{{ route('pacientes.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Volver</a>
                </div>
                            
                <form action="{{ route('pacientes.update', $paciente->id) }}" method="post" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('nombre') border-red-500 @enderror" id="nombre" name="nombre" value="{{ $paciente->nombre }}" placeholder="Ingrese el nombre del paciente" required>
                        @error('nombre')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="apellido" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Apellido</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('apellido') border-red-500 @enderror" id="apellido" name="apellido" value="{{ $paciente->apellido }}" placeholder="Ingrese el apellido del paciente" required>
                        @error('apellido')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ $paciente->email }}" placeholder="Ingrese el email del paciente" required>
                        @error('email')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="telefono" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                        <input type="tel" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('telefono') border-red-500 @enderror" id="telefono" name="telefono" value="{{ $paciente->telefono }}" placeholder="Ingrese el teléfono del paciente" required>
                        @error('telefono')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_nacimiento" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Fecha de Nacimiento</label>
                        <input type="date" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('fecha_nacimiento') border-red-500 @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}" required>
                        @error('fecha_nacimiento')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="sexo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Sexo</label>
                        <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('sexo') border-red-500 @enderror" id="sexo" name="sexo" required>
                            <option value="" disabled selected>Seleccione el sexo</option>
                            <option value="Masculino" {{ $paciente->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ $paciente->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Otro" {{ $paciente->sexo == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('sexo')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="alergias" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Alergias</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('alergias') border-red-500 @enderror" id="alergias" name="alergias" placeholder="Ingrese las alergias del paciente">{{ $paciente->alergias }}</textarea>
                        @error('alergias')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="enfermedades" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Enfermedades</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 text-gray-900 dark:text-gray-900 @error('enfermedades') border-red-500 @enderror" id="enfermedades" name="enfermedades" placeholder="Ingrese las enfermedades del paciente">{{ $paciente->enfermedades }}</textarea>
                        @error('enfermedades')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                                    <label for="medico_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Médico</label>
                                    <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('medico_id') border-red-500 @enderror" id="medico_id" name="medico_id" required>
                                        <option value="" disabled selected>Seleccione un médico</option>
                                        @foreach($medicos as $medico)
                                            <option value="{{ $medico->id }}">{{ $medico->nombres }} {{ $medico->apellidos }}</option>
                                        @endforeach
                                    </select>
                                    @error('medico_id')
                                        <span class="text-red-500 mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                    <div>
                        <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="Actualizar Paciente">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
