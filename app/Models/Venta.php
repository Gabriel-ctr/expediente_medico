<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'total', 'paciente_id'];

    /**
     * The products that belong to the sale.
     */

     public function medicamentos()
     {
         return $this->belongsToMany(Medicamento::class, 'venta_medicamento')
                     ->withPivot('cantidad', 'precio_unitario', 'total');
     }

     public function paciente()
     {
         return $this->belongsTo(Paciente::class);
     }

}
