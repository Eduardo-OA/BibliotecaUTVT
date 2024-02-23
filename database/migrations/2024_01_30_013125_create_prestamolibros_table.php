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
        Schema::create('prestamolibros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('libros_id')->constrained('libros');
            $table->foreignId('usuario_id')->constrained('users');
            $table->date('fecha_pres');
            $table->date('fecha_devo');
            $table->string('notas');
            // $table->enum('status', ['rentado', 'disponible'])->default('disponible');
            $table->enum('status', ['rentado', 'disponible'])->default('rentado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamolibros');
    }
};
