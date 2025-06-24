<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('producto')->insert([
            [
                'nombre' => 'Caja de Leche (24 unidades)',
                'peso' => 10.5,
                'unidad_medida' => 'caja',
                'alto' => 30,
                'ancho' => 25,
                'largo' => 40,
                'pvp' => 75.00,
                'costo_con_igv' => 65.00,
                'stock_mano' => 100,
                'stock_transito' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Caja de Agua (12 botellas)',
                'peso' => 8.2,
                'unidad_medida' => 'caja',
                'alto' => 35,
                'ancho' => 28,
                'largo' => 45,
                'pvp' => 48.00,
                'costo_con_igv' => 42.00,
                'stock_mano' => 150,
                'stock_transito' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Caja de Fideos (20 paquetes)',
                'peso' => 7.0,
                'unidad_medida' => 'caja',
                'alto' => 25,
                'ancho' => 20,
                'largo' => 35,
                'pvp' => 60.00,
                'costo_con_igv' => 53.00,
                'stock_mano' => 80,
                'stock_transito' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
