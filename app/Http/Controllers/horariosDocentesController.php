<?php

namespace App\Http\Controllers;


use App\Models\horariosDocentes;
use App\Models\Materias;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Scalar\String_;

use App\Exports\HorariosExport;
use Maatwebsite\Excel\Facades\Excel;



class horariosDocentesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver horarios|Crear y Editar Horarios|Eliminar Horarios'])->only('index','ver');
        $this->middleware('permission:Crear y Editar Horarios')->only('store','edit');
        $this->middleware('can:Eliminar Horarios')->only('destroy');
    }

    public function index(){

        $ListaHorarios=horariosDocentes::all();
        $ListaProfesores=app(ProfesoresController::class)->ObtenerProfesores();

        $ListaPeriodos=app(PeriodoController::class)->ObtenerPeriodos();

        $ListaUrl=[];

        foreach ($ListaHorarios as $horario) {
            $idHorario=$horario->id;
            $url="/HorariosDocentes/$idHorario/ver";
            array_push($ListaUrl, $url);
        }

        return Inertia::render('Modulos/RH/Horarios/HorariosDocentes',[
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

        return inertia('Modulos/RH/Horarios/PanelHorario',[
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


    public function destroy(String $id){
        $Horario = horariosDocentes::find($id);
        $Horario->delete();
        return Redirect::route('HorariosDocentes.index');
    }

    public function ver(String $id){
        $InfoHorario=horariosDocentes::find($id);

        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);

        return inertia('Modulos/RH/Horarios/VistaHorario',[
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

    public function GenerarPDF(String $id){
        $InfoHorario=horariosDocentes::find($id);

        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);

        return inertia('Modulos/RH/Horarios/PDF_Horario',[
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

    public function GenerarExcel(String $id){

        $InfoHorario=horariosDocentes::find($id);
        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);



        return Excel::download(new HorariosExport($id,$InfoHorario,$Materias,$Aulas,$Grupos,$ClasesLunes,$ClasesMartes,$ClasesMiercoles,$ClasesJueves,$ClasesViernes),'Horario.xlsx');
    }




    public function verExcel(String $id){
        $InfoHorario=horariosDocentes::find($id);

        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);

        return view('Reportes.Horarios',[
            'infoHorario'=>$InfoHorario,
            'Materias'=>$Materias,
            'Aulas'=>$Aulas,
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
