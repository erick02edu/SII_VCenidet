<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subdireccion')->insert([
            'Nombre' => 'Subdireccion academica',
        ]);

        DB::table('subdireccion')->insert([
            'Nombre' => 'Subdireccion de Planeacion y vinculacion',
        ]);

        DB::table('subdireccion')->insert([
            'Nombre' => 'Subdireccion de Servicios administrativos',
        ]);

        DB::table('subdireccion')->insert([
            'Nombre' => 'Direccion',
        ]);
    }
}
