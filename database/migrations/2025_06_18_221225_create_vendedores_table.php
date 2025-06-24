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
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id('id_vendedor'); // FK con usuarios
            $table->string('zona', 100)->nullable(); // Por ejemplo: "Zona Sur"
            $table->decimal('comision', 5, 2)->default(0.00); // Porcentaje de comisión
            $table->foreign('id_vendedor')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
