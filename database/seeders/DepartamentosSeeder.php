<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('departamentos')->insert([
            'Nombre' => 'Direccion',
            'Descripcion' => 'Prueba',
        ]);


        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de ingenieria mecanica',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Coordinacion de mecatronica',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Coordinacion de ciencias de la ingenieria',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de ingenieria electronica',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de ciencias computacionales',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de Organizacion y seguimiento de estudios',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de desarrollo academico e idiomas',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de planeacion, programacion y presupuestacion ',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de gestion tecnologica y vinculacion',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de comunicacion y eventos',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Centro de informacion',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Centro de computo',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de Servicios escolares',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de recursos materiales y servicios',
            'Descripcion' => 'Prueba',
        ]);

        DB::table('departamentos')->insert([
            'Nombre' => 'Departamento de recursos humanos',
            'Descripcion' => 'Prueba',
        ]);


    }
}
