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
        Schema::create('personas_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('roles_id');
            $table->boolean('estado_activo');
            $table->timestamp('fecha_asignacion');
            $table->foreign('personas_id')->references('id')->on('personas');
            $table->foreign('roles_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_roles');
    }
};
