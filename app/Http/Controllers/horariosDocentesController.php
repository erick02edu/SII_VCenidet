<?php

namespace App\Http\Controllers;

use App\Models\horariosDocentes;
use App\Models\Materias;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Scalar\String_;

class horariosDocentesController extends Controller
{
    public function index(){

        $ListaHorarios=horariosDocentes::all();
        $ListaProfesores=app(ProfesoresController::class)->ObtenerProfesores();

        $ListaPeriodos=app(PeriodoController::class)->ObtenerPeriodos();

        $ListaUrl=[];

        foreach ($ListaHorarios as $horario) {
            $idHorario=$horario->id;
            $url="/HorariosDocentes/$idHorario/edit";
            array_push($ListaUrl, $url);
        }

        return Inertia::render('HorariosDocentes',[
            'horarios'=>$ListaHorarios,
            'profesores'=>$ListaProfesores,
            'periodos'=>$ListaPeriodos,
            'ListaUrl'=>$ListaUrl
        ]);
    }

    public function store(Request $request){
        $HorarioDoc=new horariosDocentes();

        $HorarioDoc->idProfesor=$request->idProfesor;
        $HorarioDoc->idPeriodo=$request->idPeriodo;


        $HorarioDoc->save();

        $newHorarioId = $HorarioDoc->id;

        $InfoHorario=horariosDocentes::find($newHorarioId);

        // return inertia('PanelHorario',[
        //     'infoHorario'=>$InfoHorario
        // ]);

        return redirect()->route('HorariosDocentes.edit',$newHorarioId);
    }


    public function edit(String $id){

        $InfoHorario=horariosDocentes::find($id);

        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);

        

        return inertia('PanelHorario',[
            'infoHorario'=>$InfoHorario,
            'materias'=>$Materias,
            'aulas'=>$Aulas,
            'grupos'=>$Grupos,
            'idHorario'=>$id,
            'ClasesLunes'=>$ClasesLunes,
            'ClasesMartes'=>$ClasesMartes,
            'ClasesMiercoles'=>$ClasesMiercoles,
            'ClasesJueves'=>$ClasesJueves,
            'ClasesViernes'=>$ClasesViernes,
        ]);
    }


}
