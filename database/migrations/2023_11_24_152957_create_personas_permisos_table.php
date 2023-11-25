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
        Schema::create('personas_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('permisos_id');
            $table->foreign('personas_id')->references('id')->on('personas');
            $table->foreign('permisos_id')->references('id')->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_permisos');
    }
};
