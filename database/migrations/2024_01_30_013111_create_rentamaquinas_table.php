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
        Schema::create('rentamaquinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('maquina_id')->constrained('maquinas');
            $table->time('hora_inicio');
            $table->time('hora_final')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentamaquinas');
    }
};
