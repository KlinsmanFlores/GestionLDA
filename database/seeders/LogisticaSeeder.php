<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogisticaSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar 2 choferes de ejemplo
        

        // Insertar 4 vehículos representando modelos comerciales reales de furgones urbanos/interurbanos
        DB::table('flota')->insert([
            [
                'marca' => 'Toyota Hiace',
                'placa' => 'AAA-123',
                'peso_neto' => 1950,
                'peso_bruto_vehicular' => 3050,
                'capacidad_carga' => 1100,
                'alto_contenedor' => 130,    // cm
                'ancho_contenedor' => 150,   // cm
                'largo_contenedor' => 300,   // cm
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Hyundai H100',
                'placa' => 'BBB-456',
                'peso_neto' => 1900,
                'peso_bruto_vehicular' => 2800,
                'capacidad_carga' => 1000,
                'alto_contenedor' => 130,
                'ancho_contenedor' => 160,
                'largo_contenedor' => 280,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Isuzu NPR',
                'placa' => 'CCC-789',
                'peso_neto' => 2750,
                'peso_bruto_vehicular' => 5900,
                'capacidad_carga' => 3150,
                'alto_contenedor' => 210,
                'ancho_contenedor' => 210,
                'largo_contenedor' => 440,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Hino 300',
                'placa' => 'DDD-012',
                'peso_neto' => 2600,
                'peso_bruto_vehicular' => 3900,
                'capacidad_carga' => 1300,
                'alto_contenedor' => 180,
                'ancho_contenedor' => 180,
                'largo_contenedor' => 310,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
