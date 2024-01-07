<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AplicacionesPeriodosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'PROCESO DE ASPIRANTES',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'CAPTURA DE CALIFICACIONES FINALES',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'CIERRE DE PERIODOS ESCOLARES',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'CALIFICACIONES PARCIALES, GESTION DE CURSO',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'CAPTURA DE EXAMENES ESPECIALES',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'PROCESO DE REINSCRIPCION',
            'idPeriodo' => '1',
        ]);

        DB::table('aplicacion_periodos')->insert([
            'Descripcion' => 'AUTORIZACION DE RESIDENCIAS DEP',
            'idPeriodo' => '1',
        ]);

    }
}
