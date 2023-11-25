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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grados_materias_id');
            $table->unsignedBigInteger('aulas_nro');
            $table->unsignedBigInteger('dias_id');
            $table->unsignedBigInteger('horas_id');
            $table->foreign('grados_materias_id')->references('id')->on('grados_materias');
            $table->foreign('aulas_nro')->references('nro')->on('aulas');
            $table->foreign('dias_id')->references('id')->on('dias');
            $table->foreign('horas_id')->references('id')->on('horas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
