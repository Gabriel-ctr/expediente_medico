<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ServicioMedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaServiciosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Medicos
    Route::resource('medicos', MedicoController::class);

    //servicios
    Route::resource('servicios', ServicioMedicoController::class);

    //Pacientes
    Route::resource('pacientes', PacienteController::class);

    //medicamentos
    Route::resource('medicamentos', MedicamentoController::class);

    //Consultas
    Route::resource('consultas', ConsultaController::class);

    // Venta de medicamentos
    Route::resource('ventas', VentaController::class);

    // Ventas de servicios médicos
    Route::resource('ventas_servicios', VentaServiciosController::class);
});

require __DIR__.'/auth.php';
