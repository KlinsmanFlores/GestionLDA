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
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['ruc', 'razon_social']);
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('ruc', 20)->nullable();
            $table->string('razon_social', 150)->nullable();
        });
    }

};
