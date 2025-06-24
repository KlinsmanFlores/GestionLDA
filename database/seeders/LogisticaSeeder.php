<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogisticaSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar 2 choferes
        DB::table('choferes')->insert([
            ['id_chofer' => 5, 'licencia' => 'A3B'], // asegúrate de que el usuario con id 10 exista
            
        ]);

        // Insertar 2 vehículos con dimensiones reales (cm)
        DB::table('flota')->insert([
            [
                'marca' => 'Mercedes-Benz',
                'placa' => 'ABC-123',
                'peso_neto' => 3500,
                'peso_bruto_vehicular' => 7500,
                'capacidad_carga' => 4000,
                'alto_contenedor' => 220,  // cm
                'ancho_contenedor' => 200,
                'largo_contenedor' => 500,
            ],
            [
                'marca' => 'Volkswagen',
                'placa' => 'XYZ-987',
                'peso_neto' => 3000,
                'peso_bruto_vehicular' => 7000,
                'capacidad_carga' => 3500,
                'alto_contenedor' => 210,  // cm
                'ancho_contenedor' => 190,
                'largo_contenedor' => 450,
            ],
        ]);
    }
}
