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
        Schema::create('junta_grados', function (Blueprint $table) {
            $table->unsignedBigInteger('junta_escolar_id');
            $table->unsignedBigInteger('grados_id');
            $table->timestamp('fecha_asignacion');
            $table->foreign('junta_escolar_id')->references('id')->on('junta_escolar');
            $table->foreign('grados_id')->references('id')->on('grados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('junta_grados');
    }
};
