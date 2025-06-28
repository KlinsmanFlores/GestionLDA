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
        Schema::table('facturacions', function (Blueprint $table) {
            // Añadimos medio_pago justo después de la dirección
            $table->string('medio_pago', 50)
                    ->nullable()
                    ->after('direccion');
        });
    }

    public function down()
    {
        Schema::table('facturacions', function (Blueprint $table) {
            $table->dropColumn('medio_pago');
        });
    }
};
