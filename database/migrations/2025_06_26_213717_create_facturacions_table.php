<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::create('facturacions', function (Blueprint $table) {
            $table->id('id_facturacion');
            $table->unsignedBigInteger('id_cliente');
            $table->string('serie', 10)->default('F001');           // Serie del punto de venta
            $table->unsignedInteger('correlativo');                 // Correlativo incremental
            $table->string('ruc', 20);
            $table->string('razon_social', 150);
            $table->string('direccion', 255);
            $table->date('fecha');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('igv', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            // Relación con clientes
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            // Puedes agregar índices según consultas frecuentes
            $table->index(['serie', 'correlativo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturacions');
    }

};
