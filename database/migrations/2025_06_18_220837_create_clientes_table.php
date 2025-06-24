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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('ruc', 20)->unique();
            $table->string('razon_social', 150);
            $table->string('numero', 50)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->foreign('id_cliente')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
