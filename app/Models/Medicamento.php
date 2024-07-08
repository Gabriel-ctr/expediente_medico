<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad',
        'precio',
    ];

    public function ventas()
    {
        return $this->belongsToMany(Venta::class)
                    ->withPivot('cantidad', 'precio_unitario', 'total');
    }

}
