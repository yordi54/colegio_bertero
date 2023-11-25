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
        Schema::create('grados_materias', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_creacion');
            $table->unsignedBigInteger('grados_id');
            $table->unsignedBigInteger('materias_id');
            $table->unsignedBigInteger('docentes_id');
            $table->foreign('grados_id')->references('id')->on('grados');
            $table->foreign('materias_id')->references('id')->on('materias');
            $table->foreign('docentes_id')->references('personas_id')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grados_materias');
    }
};
