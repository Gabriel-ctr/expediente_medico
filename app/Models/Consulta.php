<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'motivo',
        'sintomas',
        'diagnostico',
        'tratamiento',
        'urgente',
        'paciente_id',
        'medico_id',
        'presion_arterial',
        'temperatura',
        'peso',
        'altura',
        'notas',
        'total',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
