<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Admin',
            'apellidos' => 'Principal',
            'dni' => '00000000',
            'correo' => 'admin@example.com',
            'telefono' => '999999999',
            'contrasena' => Hash::make('12345678'), // contraseña segura
            'id_rol' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
