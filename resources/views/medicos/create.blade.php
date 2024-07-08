<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Nuevo Médico') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-8">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Agregar Nuevo Médico</h2>
                    <a href="{{ route('medicos.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Volver</a>
                </div>
                
                <form action="{{ route('medicos.store') }}" method="post" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nombres" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombres</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('nombres') border-red-500 @enderror" id="nombres" name="nombres" value="{{ old('nombres') }}" placeholder="Ingrese los nombres del médico" required autofocus>
                        @error('nombres')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="apellidos" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Apellidos</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('apellidos') border-red-500 @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" placeholder="Ingrese los apellidos del médico" required>
                        @error('apellidos')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="especialidad" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Especialidad</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('especialidad') border-red-500 @enderror" id="especialidad" name="especialidad" value="{{ old('especialidad') }}" placeholder="Ingrese la especialidad del médico" required>
                        @error('especialidad')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="telefono" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                        <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('telefono') border-red-500 @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ingrese el teléfono del médico" required>
                        @error('telefono')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Ingrese el email del médico" required>
                        @error('email')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="direccion" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Dirección</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('direccion') border-red-500 @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Ingrese la dirección del médico" required>
                        @error('direccion')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="cedula" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Cédula</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('cedula') border-red-500 @enderror" id="cedula" name="cedula" value="{{ old('cedula') }}" placeholder="Ingrese la cédula del médico" required>
                        @error('cedula')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_nacimiento" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Fecha de Nacimiento</label>
                        <input type="date" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('fecha_nacimiento') border-red-500 @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                        @error('fecha_nacimiento')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="sexo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Sexo</label>
                        <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('sexo') border-red-500 @enderror" id="sexo" name="sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        @error('sexo')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="estado" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                        <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('estado') border-red-500 @enderror" id="estado" name="estado" required>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                        </select>
                        @error('estado')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="Agregar Médico">
                    </div>
                </form>
            </div>
        </div>    
    </div>
</x-app-layout>
