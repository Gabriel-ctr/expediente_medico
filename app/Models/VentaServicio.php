<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class VentaServicio extends Model
{
    use HasFactory;

    protected $table = 'venta_de_servicios';

    protected $fillable = [
        'paciente_id', 
        'fecha', 
        'total'
    ];

    public function servicios()
    {
        return $this->belongsToMany(ServicioMedico::class, 'venta_varios_servicios')
                    ->withPivot('total')
                    ->withTimestamps();
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
