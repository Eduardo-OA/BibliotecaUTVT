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
        Schema::create('libros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('autor_principal'); 
            $table->string('autores')->nullable();
            $table->string('genero');
            $table->string('editorial');
            $table->string('idioma');
            $table->integer('cantidad');
            $table->boolean('disponibilidad');
            $table->string('ubicacion');
            $table->date('fechaadqui');
            // $table->enum('status', ['rentado', 'disponible'])->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
