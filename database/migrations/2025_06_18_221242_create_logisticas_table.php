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
        Schema::dropIfExists('logisticas');
        Schema::create('logisticas', function (Blueprint $table) {
            // PK autoincremental
            $table->id('id_logistica');
            // FK a usuarios (1:1)
            $table->unsignedBigInteger('id_usuario')->unique();
            $table->foreign('id_usuario')
                ->references('id_usuario')->on('usuarios')
                ->onDelete('cascade');
            $table->string('almacen_base', 150)->nullable();
            $table->string('area_asignada', 100)->nullable();
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
