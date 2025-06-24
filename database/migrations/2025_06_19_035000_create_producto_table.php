<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre', 150);
            $table->float('peso');
            $table->string('unidad_medida', 50);
            $table->float('alto')->nullable();
            $table->float('ancho')->nullable();
            $table->float('largo')->nullable();
            $table->float('pvp');
            $table->float('costo_con_igv')->nullable();
            $table->integer('stock_mano')->default(0);
            $table->integer('stock_transito')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
