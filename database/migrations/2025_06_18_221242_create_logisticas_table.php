<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logisticas', function (Blueprint $table) {
            $table->id('id_logistica'); // FK con usuarios
            $table->string('almacen_base', 150)->nullable(); // Almacén donde trabaja
            $table->string('area_asignada', 100)->nullable(); // Área como "Recepción", "Despacho"
            $table->foreign('id_logistica')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logisticas');
    }
};
