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
                'nombre'            => 'Caja de Leche (24 unidades)',
                'peso'              => 10.5,
                'unidad_medida'     => 'caja',
                'alto'              => 30,
                'ancho'             => 25,
                'largo'             => 40,
                'pvp'               => 75.00,
                'costo_con_igv'     => 65.00,
                'stock_mano'        => 100,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nombre'            => 'Caja de Agua (12 botellas)',
                'peso'              => 8.2,
                'unidad_medida'     => 'caja',
                'alto'              => 35,
                'ancho'             => 28,
                'largo'             => 45,
                'pvp'               => 48.00,
                'costo_con_igv'     => 42.00,
                'stock_mano'        => 150,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nombre'            => 'Caja de Fideos (20 paquetes)',
                'peso'              => 7.0,
                'unidad_medida'     => 'caja',
                'alto'              => 25,
                'ancho'             => 20,
                'largo'             => 35,
                'pvp'               => 60.00,
                'costo_con_igv'     => 53.00,
                'stock_mano'        => 80,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Tres productos más
            [
                'nombre'            => 'Paquete de Arroz (10 kg)',
                'peso'              => 10.0,
                'unidad_medida'     => 'paquete',
                'alto'              => 50,
                'ancho'             => 30,
                'largo'             => 15,
                'pvp'               => 45.00,
                'costo_con_igv'     => 40.00,
                'stock_mano'        => 200,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nombre'            => 'Botella de Aceite (1 L)',
                'peso'              => 1.2,
                'unidad_medida'     => 'botella',
                'alto'              => 25,
                'ancho'             => 8,
                'largo'             => 8,
                'pvp'               => 15.00,
                'costo_con_igv'     => 13.00,
                'stock_mano'        => 120,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nombre'            => 'Lata de Atún (200 g)',
                'peso'              => 0.2,
                'unidad_medida'     => 'lata',
                'alto'              => 5,
                'ancho'             => 7,
                'largo'             => 7,
                'pvp'               => 6.50,
                'costo_con_igv'     => 5.50,
                'stock_mano'        => 300,
                'stock_transito'    => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
