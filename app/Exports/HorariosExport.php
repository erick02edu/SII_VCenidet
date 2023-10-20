<?php

namespace App\Exports;

namespace App\Exports;


use App\Invoice;

//Modelos
use App\Models\Aula;
use App\Models\Clases;
use App\Models\Grupos;
use App\Models\Materias;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithStyles; //DEFINIR ESTILOS


class HorariosExport implements FromView , ShouldAutoSize
{

    public $idHorario;
    public $InfoHorario;
    public $Materias;
    public $Aulas;
    public $Grupos;
    public $ClasesLunes;
    public $ClasesMartes;
    public $ClasesMiercoles;
    public $ClasesJueves;
    public $ClasesViernes;


    public function __construct($id,$InfoHorario,$Materias,$Aulas,$Grupos,$ClasesLunes,$ClasesMartes,$ClasesMiercoles,$ClasesJueves,$ClasesViernes) {

        $this->idHorario=$id;
        $this->InfoHorario = $InfoHorario;
        $this->Materias=$Materias;
        $this->Aulas=$Aulas;
        $this->Grupos=$Grupos;
        $this->ClasesLunes=$ClasesLunes;
        $this->ClasesMartes=$ClasesMartes;
        $this->ClasesMiercoles=$ClasesMiercoles;
        $this->ClasesJueves=$ClasesJueves;
        $this->ClasesViernes=$ClasesViernes;
    }




    public function view():View
    {

        //dd($this->InfoHorario, $this->Materias, $this->Aulas);

        return view('Reportes.Horarios',[
            'Materias'=>Materias::all(),
            'Aulas'=>Aula::all(),
            'Grupos'=>Grupos::all(),
            'ClasesLunes'=>Clases::where('dia', 'Lunes')->where('idHorario',$this->idHorario)->get(),
            'ClasesMartes'=>Clases::where('dia', 'Martes')->where('idHorario',$this->idHorario)->get(),
            'ClasesMiercoles'=>Clases::where('dia', 'Miercoles')->where('idHorario',$this->idHorario)->get(),
            'ClasesJueves'=>Clases::where('dia', 'Jueves')->where('idHorario',$this->idHorario)->get(),
            'ClasesViernes'=>Clases::where('dia', 'Viernes')->where('idHorario',$this->idHorario)->get(),
        ]);
    }


}
