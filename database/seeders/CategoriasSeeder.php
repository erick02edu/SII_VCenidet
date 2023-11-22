<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            'Descripcion' => 'Jefe de Mesa',
            'Clave' => 'A01004',
            'Horas' => '36',
        ]);


        DB::table('categorias')->insert([
            'Descripcion' => 'Jefe de Proyecto',
            'Clave' => 'A01009',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Analista de sistemas administrativos',
            'Clave' => 'A04003',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Secretario Bilingue',
            'Clave' => 'A08003',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Secretario de director del plantel',
            'Clave' => 'A08016',
            'Horas' => '36',
        ]);


        DB::table('categorias')->insert([
            'Descripcion' => 'Secretario de jefe de departamento',
            'Clave' => 'A08029',
            'Horas' => '36',
        ]);


        DB::table('categorias')->insert([
            'Descripcion' => 'Tecnico docente asignatura B',
            'Clave' => 'E3507',
            'Horas' => '36',
        ]);


        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor de asignatura A E.S',
            'Clave' => 'E3519',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor de asignatura B E.S',
            'Clave' => 'E3521',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor de asignatura C E.S',
            'Clave' => 'E3525',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor asociado B E.S',
            'Clave' => 'E3809',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor asociado C E.S',
            'Clave' => 'E3811',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor titular A E.S',
            'Clave' => 'E3813',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor titular B E.S',
            'Clave' => 'E3815',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Profesor titular C E.S',
            'Clave' => 'E3817',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Tecnico Docente Asociado A E.S',
            'Clave' => 'E3837',
            'Horas' => '36',
        ]);

        DB::table('categorias')->insert([
            'Descripcion' => 'Tecnico Docente Asociado B E.S',
            'Clave' => 'E3839',
            'Horas' => '36',
        ]);

    }
}
