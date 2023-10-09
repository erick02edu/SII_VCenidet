<?php

namespace App\Http\Controllers;
use App\Models\Periodos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeriodoController extends Controller
{
    public function index(Request $request){
        $Periodos=Periodos::all();
        return Inertia::render('Promedio',['calificaciones'=>$request,'periodos'=>$Periodos]);
    }


    public function ObtenerPeriodos(){
        $Periodos=Periodos::all();
        return $Periodos;
    }

    public function buscarPeriodoCompleto(Request $request){
        $PeriodoBuscar=$request->input('periodoBuscar');

        //CONCAT(nombre, ' ', apellidoP, ' ', apellidoM) LIKE ?", ["%$nombreCompleto%"]
        //$result=User::where($campo, 'LIKE', '%'.$Usuario.'%')->get();
        //$ListaPeriodos=Periodos::where("CONCAT(mesInicio,' ',AñoInicio,'-',mesTermino,' ',AñoTermino)",'LIKE','%'.$PeriodoBuscar.'%')->get();


        $ListaPeriodos=Periodos::whereRaw("CONCAT(mesInicio,' ',AñoInicio,'-',mesTermino,' ',AñoTermino) LIKE ?", ["%$PeriodoBuscar%"])
        ->get();

        return $ListaPeriodos;
    }
}
