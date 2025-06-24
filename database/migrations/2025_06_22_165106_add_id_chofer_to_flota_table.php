<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('flota', function (Blueprint $table) {
            $table->unsignedBigInteger('id_chofer')->nullable()->after('id_flota');
            $table->foreign('id_chofer')->references('id_usuario')->on('usuarios')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('flota', function (Blueprint $table) {
            $table->dropForeign(['id_chofer']);
            $table->dropColumn('id_chofer');
        });
    }
};
