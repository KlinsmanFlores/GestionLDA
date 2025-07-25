<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'administrador'],
            ['nombre' => 'cliente'],
            ['nombre' => 'chofer'],
            ['nombre' => 'vendedor'],
            ['nombre' => 'logistica'],
        ]);
    }
}
