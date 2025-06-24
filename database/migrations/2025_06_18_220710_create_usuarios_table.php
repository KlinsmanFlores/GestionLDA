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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('dni', 20)->unique();
            $table->string('correo', 150)->unique();
            $table->string('telefono', 50)->nullable();
            $table->string('contrasena');
            $table->unsignedBigInteger('id_rol'); 
            $table->timestamps();

            
            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
