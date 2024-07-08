<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioMedico extends Model
{
    use HasFactory;
    // Definir los campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'descripcion',
        'costo',
        'medico_id',
        'paciente_id',
    ];    
    
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }




    
}
