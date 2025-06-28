<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Eliminar redundancias
            $table->dropColumn(['correo', 'numero']);
            // Agregar nuevos campos
            $table->string('tipo_cliente', 20)->nullable();    // natural o juridico
        
            $table->string('referencia', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Restaurar campos eliminados
            $table->string('correo', 150)->nullable();
            $table->string('numero', 50)->nullable();
            // Eliminar campos agregados
            $table->dropColumn(['tipo_cliente', 'referencia']);
        });
    }

};
