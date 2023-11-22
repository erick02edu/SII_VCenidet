<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $i=0;

        $añoActual=2023;

        $añoInicio=2000;


        for($añoActual ; $añoActual>=$añoInicio ; $añoActual--){

            $añoSiguiente=$añoActual+1;


            if($añoActual>=2020){
                DB::table('periodos')->insert([
                    'mesTermino' => 'Febrero',
                    'AñoTermino' => $añoSiguiente,
                    'mesInicio' => 'Agosto',
                    'AñoInicio' => $añoActual,
                ]);


                DB::table('periodos')->insert([
                    'mesTermino' => 'Julio',
                    'AñoTermino' => $añoActual,
                    'mesInicio' => 'Febrero',
                    'AñoInicio' => $añoActual,
                ]);
            }

            if($añoActual<2020 && $añoActual>2013){
                DB::table('periodos')->insert([
                    'mesTermino' => 'Enero',
                    'AñoTermino' => $añoSiguiente,
                    'mesInicio' => 'Agosto',
                    'AñoInicio' => $añoActual,
                ]);


                DB::table('periodos')->insert([
                    'mesTermino' => 'Julio',
                    'AñoTermino' => $añoActual,
                    'mesInicio' => 'Febrero',
                    'AñoInicio' => $añoActual,
                ]);

            }

            if($añoActual<=2013){
                DB::table('periodos')->insert([
                    'mesTermino' => 'Enero',
                    'AñoTermino' => $añoSiguiente,
                    'mesInicio' => 'Agosto',
                    'AñoInicio' => $añoActual,
                ]);


                DB::table('periodos')->insert([
                    'mesTermino' => 'Junio',
                    'AñoTermino' => $añoActual,
                    'mesInicio' => 'Enero',
                    'AñoInicio' => $añoActual,
                ]);
            }
        }



        // //PERIODOS EN 2023
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2024',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2023',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2023',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2023',
        // ]);


        // //PERIODOS EN 2022
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2023',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2022',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2022',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2022',
        // ]);

        // //PERIODOS EN 2021
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2022',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2021',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2021',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2021',
        // ]);



        // //PERIODOS EN 2020
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2021',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2020',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2020',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2020',
        // ]);

        // //PERIODOS EN 2019
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2020',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2019',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2019',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2019',
        // ]);


        // //PERIODOS EN 2018
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2019',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2018',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2018',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2018',
        // ]);

        // //PERIODOS EN 2017
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2018',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2017',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2017',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2017',
        // ]);

        // //PERIODOS EN 2016
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2017',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2016',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2016',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2016',
        // ]);

        // //PERIODOS EN 2015
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2016',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2015',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2015',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2015',
        // ]);


        // //PERIODOS EN 2014
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2015',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2014',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2014',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2014',
        // ]);

        // //PERIODOS EN 2013
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2014',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2013',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2013',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2013',
        // ]);

        // //PERIODOS EN 2012
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2013',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2012',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2012',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2012',
        // ]);

        // //PERIODOS EN 2011
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2012',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2011',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2011',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2011',
        // ]);

        // //PERIODOS EN 2010
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2011',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2010',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2010',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2010',
        // ]);

        // //PERIODOS EN 2010
        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2011',
        //     'mesInicio' => 'Agosto',
        //     'AñoInicio' => '2010',
        // ]);

        // DB::table('periodos')->insert([
        //     'mesTermino' => 'Febrero',
        //     'AñoTermino' => '2010',
        //     'mesInicio' => 'Julio',
        //     'AñoInicio' => '2010',
        // ]);



    }
}
