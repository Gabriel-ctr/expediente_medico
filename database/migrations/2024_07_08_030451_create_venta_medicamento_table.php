<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaMedicamentoTable extends Migration
{
    public function up()
    {
        Schema::create('venta_medicamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('medicamento_id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total', 10, 2); // Opcional: puedes calcular el total aquí o en la lógica de tu aplicación
            $table->timestamps();

            // Claves foráneas
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('venta_medicamento');
    }
}
