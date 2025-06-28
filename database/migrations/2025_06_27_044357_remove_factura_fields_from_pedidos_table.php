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
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropColumn([
            'ruc',
            'razon_social',
            'direccion_fiscal',
            'medio_pago',
            'subtotal',
            'igv',
            'total',
        ]);
    });
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->string('ruc', 20)->nullable();
        $table->string('razon_social', 255)->nullable();
        $table->string('direccion_fiscal', 255)->nullable();
        $table->string('medio_pago', 50)->nullable();
        $table->decimal('subtotal', 10, 2)->default(0);
        $table->decimal('igv', 10, 2)->default(0);
        $table->decimal('total', 10, 2)->default(0);
    });
}

};
