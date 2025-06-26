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
        Schema::dropIfExists('vendedores');
        Schema::create('vendedores', function (Blueprint $table) {
            // PK autoincremental
            $table->id('id_vendedor');
            // FK a usuarios (1:1)
            $table->unsignedBigInteger('id_usuario')->unique();
            $table->foreign('id_usuario')
                ->references('id_usuario')->on('usuarios')
                ->onDelete('cascade');
            $table->string('zona', 100)->nullable();
            $table->decimal('comision', 5, 2)->default(0.00);
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
