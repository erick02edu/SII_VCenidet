<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Activo',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por abandono de Empleo',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por cambio de adscripcion',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por defuncion',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por incapacidad I.S.S.S.T.E',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por insubsistencia de nombramiento',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por jubilacion',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por renuncia',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por resolucion del tribunal de concilacion y arbitraje',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por sentencia Judicial',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Baja por termino de nombramiento',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Licencia por asuntos particulares',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Licencia por beca',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Licencia por comision sindical o eleccion popular',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Licencia por gravidez',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Licencia pre pensionada',
        ]);

        DB::table('estatus empleado')->insert([
            'Descripcion' => 'Sabatico',
        ]);


    }

}
