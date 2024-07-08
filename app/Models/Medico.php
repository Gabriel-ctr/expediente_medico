<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar
    protected $fillable = [
        'nombres',
        'apellidos',
        'especialidad',
        'telefono',
        'email',
        'direccion',
        'cedula',
        'fecha_nacimiento',
        'sexo',
        'estado',
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

    public function serviciosMedicos()
    {
        return $this->hasMany(ServicioMedico::class);
    }

}
