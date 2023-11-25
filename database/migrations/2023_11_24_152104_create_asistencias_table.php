<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('asistencias', function (Blueprint $table) {
                $table->id();
                $table->string('tiempo_retraso', 15)->nullable();
                $table->time('hora_ingreso');
                $table->time('hora_salida');
                $table->timestamp('fecha');
                $table->unsignedBigInteger('docentes_id');
                $table->foreign('docentes_id')->references('personas_id')->on('docentes');
                $table->timestamps();
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
