<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->text('motivo');
            $table->text('sintomas')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->boolean('urgente')->default(false); // Consulta urgente
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('medico_id')->nullable(); // Médico que realizó la consulta
            $table->integer('presion_arterial')->nullable(); // Presión arterial del paciente
            $table->integer('temperatura')->nullable(); // Temperatura del paciente
            $table->float('peso')->nullable(); // Peso del paciente en kilogramos
            $table->float('altura')->nullable(); // Altura del paciente en metros
            $table->text('notas')->nullable(); // Notas adicionales
            $table->float('total')->nullable(); // Total de la consulta
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('paciente_id')->references('id')->on('pacientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('medico_id')->references('id')->on('medicos')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
