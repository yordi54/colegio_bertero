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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('ci', 10);
            $table->string('nombres', 150);
            $table->string('apellidos', 250);
            $table->string('telefono', 17)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('sexo', 1);
            $table->string('email', 100);
            $table->text('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
