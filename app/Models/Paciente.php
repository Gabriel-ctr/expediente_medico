<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_nacimiento',
        'sexo',
        'alergias',
        'enfermedades',
        'medico_id',    
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function serviciosMedicos()
    {
        return $this->hasMany(ServicioMedico::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function ventas()
    {
        return $this->belongsToMany(Medicamento::class)
                    ->withPivot('cantidad', 'precio_unitario', 'total');
    }

}
