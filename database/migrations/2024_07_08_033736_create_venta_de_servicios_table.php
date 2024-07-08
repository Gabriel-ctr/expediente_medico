<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaDeServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('venta_de_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id');
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('venta_de_servicios');
    }
}
