<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flota', function (Blueprint $table) {
            $table->id('id_flota');
            $table->string('marca');
            $table->string('placa')->unique();
            $table->float('peso_neto')->nullable();
            $table->float('peso_bruto_vehicular')->nullable();
            $table->float('capacidad_carga'); // en Kg
            $table->float('alto_contenedor'); // en cm
            $table->float('ancho_contenedor'); // en cm
            $table->float('largo_contenedor'); // en cm
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flota');
    }
};