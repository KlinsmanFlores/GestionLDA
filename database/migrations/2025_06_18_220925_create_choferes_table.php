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
        Schema::create('choferes', function (Blueprint $table) {
            $table->id('id_chofer');

            // modificado: agregada columna de FK a usuarios
            $table->unsignedBigInteger('id_usuario'); // modificado
            $table->foreign('id_usuario')
                ->references('id_usuario')->on('usuarios')
                  ->onDelete('cascade'); // modificado

            $table->string('licencia', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choferes');
    }
};
