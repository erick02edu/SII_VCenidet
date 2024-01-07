<?php

namespace App\Http\Controllers;
use App\Models\Periodos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeriodoController extends Controller
{
    //Funcion index para vista 
    public function index(Request $request){
        $Periodos=Periodos::all();
        return Inertia::render('Promedio',['calificaciones'=>$request,'periodos'=>$Periodos]);
    }

    public function ObtenerPeriodos(){
        $Periodos=Periodos::all();
        return $Periodos;
    }

    public function ObtenerPeriodoPorID(String $id){
        $Periodo=Periodos::find($id);
        return $Periodo;
    }

    public function buscarPeriodoCompleto(Request $request){
        $PeriodoBuscar=$request->input('periodoBuscar');
        $ListaPeriodos=Periodos::whereRaw("CONCAT(mesInicio,' ',AñoInicio,'-',mesTermino,' ',AñoTermino) LIKE ?", ["%$PeriodoBuscar%"])
        ->get();
        return $ListaPeriodos;
    }

    public function VerificarExistencia(String $id){

        $Periodo=Periodos::find($id);
        if($Periodo){
            return true;
        }
        else{
            return false;
        }
    }
}
