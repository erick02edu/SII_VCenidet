<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias de la computacion',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Doctorado',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria electronica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Doctorado',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias de la ingenieria',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Doctorado',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria mecatronica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Doctorado',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Semiconductores',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Especialidad',
        ]);


        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria electronica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Doctorado',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Electromecanica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Ingenieria',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias de la computacion',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Maestria',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria electronica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Maestria',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria mecanica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Maestria',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias de la ingenieria',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Maestria',
        ]);

        DB::table('carreras')->insert([
            'Nombre' => 'Ciencias en ingenieria mecatronica',
            'Descripcion' => '',
            'Duracion_Años' => '2',
            'Nivel' => 'Maestria',
        ]);
    }
}
