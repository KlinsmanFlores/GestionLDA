<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('ruc')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('direccion_fiscal')->nullable();
            $table->string('medio_pago')->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('igv', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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

};
