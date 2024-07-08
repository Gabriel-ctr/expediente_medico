<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaVariosServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('venta_varios_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_de_servicio_id');
            $table->foreignId('servicio_id');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('venta_varios_servicios');
    }
}
