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
        Schema::create('MantenimientoMaquina', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('maquina_id')->nullable(); // Cambia a 'nullable'
            $table->foreign('maquina_id')->references('id')->on('maquinas')->onDelete('set null');
            $table->text('detalle')->nullable();
            $table->integer('id_maquina_eliminada')->nullable(); // Campo que indica a que maquina pertenecia el registro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MantenimientoMaquina');
    }
};
