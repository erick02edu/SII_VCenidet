<?php

namespace App\Imports;

use App\Models\Alumnos;
use App\Models\Grupos;
use App\Models\Periodos;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //Permitir enlazar encabezados del excel para la importacion
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;


class AlumnosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        //TRANSFORMAR LA FECHA
        $fechaNac = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']));
        //OBTENER PERIODO COMPLETO DEL EXCEL
        $PeriodoCompleto=$row['periodo_actual'];
        // Dividir el string por el caracter "-" para obtener datos
        $partesPeriodo = explode('-', $PeriodoCompleto);
        $i=0;
        foreach ($partesPeriodo as $parte) {
            if($i==0){
                $mesInicio=$parte;
            }
            if($i==1){
                $AñoInicio=$parte;
            }
            if($i==2){
                $mesTermino=$parte;
            }
            if($i==3){
                $AñoTermino=$parte;
            }
            $i++;
        }
        //Obtener idPeriodo
        $idPeriodo=Periodos::
        where('mesInicio',$mesInicio)->
        where('AñoInicio',$AñoInicio)->
        where('mesTermino',$mesTermino)->
        where('AñoTermino',$AñoTermino)->
        value('id');
        //OBTENER IDGRUPO
        $Semestre=$row['semestre'];
        $Letra=$row['grupo'];
        $Especialidad=$row['especialidad'];
        $idGrupo=Grupos::
        where('Semestre',$Semestre)->
        where('Letra',$Letra)->
        where('Especialidad',$Especialidad)->
        where('idPeriodo',$idPeriodo)->
        value('id');

        return new Alumnos([
            // Realizar mapeo de los datos
            //Colum.BD ----- Colum.Excel
            'Nombre'=>$row['nombre'],
            'ApellidoP'=>$row['apellido_paterno'],
            'ApellidoM'=>$row['apellido_materno'],
            'FechaNac'=>$fechaNac,
            'noControl'=>$row['numcontrol'],
            'curp'=>$row['curp'],
            'Direccion'=>$row['direccion'],
            'Genero'=>$row['genero'],
            'Telefono'=>$row['telefono'],
            'idGrupo'=>$idGrupo,

        ]);
    }
}
