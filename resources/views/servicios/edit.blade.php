<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Servicio Médico') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-8">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Editar Servicio Médico</h2>
                    <a href="{{ route('servicios.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Volver</a>
                </div>
                
                <form action="{{ route('servicios.update', $servicio->id) }}" method="post" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('nombre') border-red-500 @enderror" id="nombre" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" placeholder="Ingrese el nombre del servicio" required>
                        @error('nombre')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('descripcion') border-red-500 @enderror" id="descripcion" name="descripcion" placeholder="Ingrese la descripción del servicio" required>{{ old('descripcion', $servicio->descripcion) }}</textarea>
                        @error('descripcion')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="costo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Costo</label>
                        <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('costo') border-red-500 @enderror" id="costo" name="costo" value="{{ old('costo', $servicio->costo) }}" placeholder="Ingrese el costo del servicio" required>
                        @error('costo')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="medico_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Médico</label>
                        <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('medico_id') border-red-500 @enderror" id="medico_id" name="medico_id" required>
                            <option value="" disabled>Seleccione un médico</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}" @if($servicio->medico_id == $medico->id) selected @endif>{{ $medico->nombres }} {{ $medico->apellidos }}</option>
                            @endforeach
                        </select>
                        @error('medico_id')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="paciente_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Paciente</label>
                        <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('paciente_id') border-red-500 @enderror" id="paciente_id" name="paciente_id" required>
                            <option value="" disabled>Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" @if($servicio->paciente_id == $paciente->id) selected @endif>{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="Actualizar Servicio Médico">
                    </div>
                </form>
            </div>
        </div>    
    </div>
</x-app-layout>
