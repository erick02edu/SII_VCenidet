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
use DateTime;
use Exception;
use Illuminate\Support\Facades\Session;

class horariosDocentesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['permission:Ver horarios|Crear y Editar Horarios|Eliminar Horarios'])->only('index','ver');
    //     $this->middleware('permission:Crear y Editar Horarios')->only('store','edit');
    //     $this->middleware('can:Eliminar Horarios')->only('destroy');
    // }

    public function __construct(){
        $this->middleware(['role:Recursos Humanos'])->only('index','ver');
        $this->middleware(['role:Recursos Humanos'])->only('store','edit');
        $this->middleware(['role:Recursos Humanos'])->only('destroy');
    }

    public function index(){

        //$ListaHorarios=horariosDocentes::all();

        $Pagination=horariosDocentes::paginate(5);

        $ListaHorarios=$Pagination->items();


        $ListaProfesores=app(PersonalController::class)->ObtenerPersonal();

        $ListaPeriodos=app(PeriodoController::class)->ObtenerPeriodos();
        $ListaaDepartamentos=app(DepartamentoController::class)->ObtenerDepartamentos();

        $ListaUrl=[];

        foreach ($ListaHorarios as $horario) {
            $idHorario=$horario->id;
            $url="/HorariosDocentes/$idHorario/ver";
            //$url="/formatoPDF/$idHorario";
            array_push($ListaUrl, $url);
        }

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/RH/Horarios/HorariosDocentes',[
            'horarios'=>$ListaHorarios,
            'profesores'=>$ListaProfesores,
            'periodos'=>$ListaPeriodos,
            'ListaUrl'=>$ListaUrl,
            'departamentos'=>$ListaaDepartamentos,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }

    public function store(Request $request){
        $HorarioDoc=new horariosDocentes();

        $HorarioDoc->idProfesor=$request->idProfesor;
        $HorarioDoc->idPeriodo=$request->idPeriodo;


        $HorarioDoc->save();

        $newHorarioId = $HorarioDoc->id;

        $InfoHorario=horariosDocentes::find($newHorarioId);

        return redirect()->route('HorariosDocentes.editAdmin',$newHorarioId);
    }


    public function edit(String $id){

        $InfoHorario=horariosDocentes::find($id);

        $Materias=app(MateriasController::class)->ObtenerMaterias();
        $Aulas=app(AulaController::class)->ObtenerAulas();
        $Grupos=app(GruposController::class)->ObtenerGruposPorPeriodo($InfoHorario->idPeriodo);
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();

        $PeriodoHorario=app(PeriodoController::class)->ObtenerPeriodoPorID($InfoHorario->idPeriodo);
        $ProfesorHorario=app(PersonalController::class)->ObtenerPersonalPorID($InfoHorario->idProfesor);

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
            'periodos'=>$Periodos,
            'idHorario'=>$id,
            'ClasesLunes'=>$ClasesLunes,
            'ClasesMartes'=>$ClasesMartes,
            'ClasesMiercoles'=>$ClasesMiercoles,
            'ClasesJueves'=>$ClasesJueves,
            'ClasesViernes'=>$ClasesViernes,
            'PeriodoHorario'=>$PeriodoHorario,
            'ProfesorHorario'=>$ProfesorHorario
        ]);
    }

    public function editAdministrativo(String $id){

        $InfoHorario=horariosDocentes::find($id);



        if($InfoHorario==null){
            return redirect()->route('HorariosDocentes.index');
        }

        $periodo=app(PeriodoController::class)->ObtenerPeriodoPorID($InfoHorario->idPeriodo);

        $Personal=app(PersonalController::class)->ObtenerPersonalPorID($InfoHorario->idProfesor);
        $DiasLunes=app(DiasHorarioController::class)->ObtenerDiasHorario('Lunes',$id);
        $DiasMartes=app(DiasHorarioController::class)->ObtenerDiasHorario('Martes',$id);
        $DiasMiercoles=app(DiasHorarioController::class)->ObtenerDiasHorario('Miercoles',$id);
        $DiasJueves=app(DiasHorarioController::class)->ObtenerDiasHorario('Jueves',$id);
        $DiasViernes=app(DiasHorarioController::class)->ObtenerDiasHorario('Viernes',$id);
        $DiasSabado=app(DiasHorarioController::class)->ObtenerDiasHorario('Sabado',$id);

        //Calcular horas Lunes
        if($DiasLunes->isEmpty()){
            $DiasLunes=null;
            $HorasTotalesLunes=0;
            $minutosTotalesLunes=0;
        }
        else{
            $horaInicio=$DiasLunes[0]->HInicio;
            $horaFin=$DiasLunes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesLunes = $interval->h;
            $minutosTotalesLunes = $interval->i;
        }

        //Calcular horas martes
        if($DiasMartes->isEmpty()){
            $DiasMartes=null;
            $HorasTotalesMartes=0;
            $minutosTotalesMartes=0;
        }
        else{
            $horaInicio=$DiasMartes[0]->HInicio;
            $horaFin=$DiasMartes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMartes = $interval->h;
            $minutosTotalesMartes = $interval->i;
        }

        //Calcular horas miercoles
        if($DiasMiercoles->isEmpty()){
            $DiasMiercoles=null;
            $HorasTotalesMiercoles=0;
            $minutosTotalesMiercoles=0;
        }
        else{
            $horaInicio=$DiasMiercoles[0]->HInicio;
            $horaFin=$DiasMiercoles[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMiercoles = $interval->h;
            $minutosTotalesMiercoles = $interval->i;
        }

        //Calcular horas jueves
        if($DiasJueves->isEmpty()){
            $DiasJueves=null;
            $HorasTotalesJueves=0;
            $minutosTotalesJueves=0;
        }
        else{
            $horaInicio=$DiasJueves[0]->HInicio;
            $horaFin=$DiasJueves[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesJueves = $interval->h;
            $minutosTotalesJueves = $interval->i;
        }


        //Calcular horas viernes
        if($DiasViernes->isEmpty()){
            $DiasViernes=null;
            $HorasTotalesViernes=0;
            $minutosTotalesViernes=0;
        }
        else{
            $horaInicio=$DiasViernes[0]->HInicio;
            $horaFin=$DiasViernes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesViernes = $interval->h;
            $minutosTotalesViernes = $interval->i;
        }

        //Calcular horas sabado
        if($DiasSabado->isEmpty()){
            $DiasSabado=null;
            $HorasTotalesSabado=0;
            $minutosTotalesSabado=0;
        }
        else{
            $horaInicio=$DiasSabado[0]->HInicio;
            $horaFin=$DiasSabado[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesSabado = $interval->h;
            $minutosTotalesSabado = $interval->i;
        }


        //Calcular horas totales
        //Sumar las horas y los minutos
        $total_horas = $HorasTotalesLunes + $HorasTotalesMartes+$HorasTotalesMiercoles+$HorasTotalesJueves+$HorasTotalesViernes+$HorasTotalesSabado;
        $total_minutos =$minutosTotalesLunes+$minutosTotalesMartes+$minutosTotalesMiercoles+$minutosTotalesJueves+$minutosTotalesViernes+$minutosTotalesSabado;

        // Ajustar los minutos si superan 59
        if ($total_minutos >= 60) {
            $total_minutos -= 60;
            $total_horas += 1;
        }

        return inertia('Modulos/RH/Horarios/PanelHorarioAdministrativo',[
            'infoHorario'=>$InfoHorario,
            'periodo'=>$periodo,
            'idHorario'=>$id,
            'DiaLunes'=>$DiasLunes,
            'DiaMartes'=>$DiasMartes,
            'DiaMiercoles'=>$DiasMiercoles,
            'DiaJueves'=>$DiasJueves,
            'DiaViernes'=>$DiasViernes,
            'DiaSabado'=>$DiasSabado,

            'HorasTotalesLunes'=>$HorasTotalesLunes,
            'minutosTotalesLunes'=>$minutosTotalesLunes,
            'HorasTotalesMartes'=>$HorasTotalesMartes,
            'minutosTotalesMartes'=>$minutosTotalesMartes,
            'HorasTotalesMiercoles'=>$HorasTotalesMiercoles,
            'minutosTotalesMiercoles'=>$minutosTotalesMiercoles,
            'HorasTotalesJueves'=>$HorasTotalesJueves,
            'minutosTotalesJueves'=>$minutosTotalesJueves,
            'HorasTotalesViernes'=>$HorasTotalesViernes,
            'minutosTotalesViernes'=>$minutosTotalesViernes,
            'HorasTotalesSabado'=>$HorasTotalesSabado,
            'minutosTotalesSabado'=>$minutosTotalesSabado,

            'personal'=>$Personal,
            'HorasSemana'=>$total_horas,
            'MinutosSemana'=>$total_minutos
        ]);
    }


    public function destroy(String $id){
        try{
            $Horario = horariosDocentes::find($id);
            $Horario->delete();
            Session::flash('mensaje', 'Horario eliminado correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('HorariosDocentes.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ocurrio un error al eliminar el horario');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('HorariosDocentes.index');
        }
    }

    public function ver(String $id){


        $Horario=horariosDocentes::find($id);

        if($Horario==null){
            return redirect()->route('HorariosDocentes.index');
        }

        $idPersonal=$Horario->idProfesor;
        $idPeriodo=$Horario->idPeriodo;
        $Personal=app(PersonalController::class)->ObtenerPersonalPorID($idPersonal);
        $Periodo=app(PeriodoController::class)->ObtenerPeriodoPorID($idPeriodo);

        //COMPROBAR SI TIENE UNA PLAZA
        if($Personal->idPlaza!=null){
            //OBTENER INFORMACION DE LA PLAZA Y SU CATEGORIA
            $Plaza=app(PlazaController::class)->ObtenerPlazaPorID($Personal->idPlaza);
            $Categoria=app(CategoriaController::class)->ObtenerCategoriaPorID($Plaza->idCategoria);

        }
        else{
            //SI NO TIENE PLAZA
            $Plaza=null;
            $Categoria=null;
        }

        $DepartamentoAdscripcion=app(DepartamentoController::class)->ObtenerDepartamentoPorID($Personal->idDepAdscripcion);

        if($DepartamentoAdscripcion->idEncargado!=null){
            $EncargadoDepAdscripcion=app(PersonalController::class)->ObtenerPersonalPorID($DepartamentoAdscripcion->idEncargado);
        }
        else{
            $EncargadoDepAdscripcion=null;
        }
        $DiasLunes=app(DiasHorarioController::class)->ObtenerDiasHorario('Lunes',$id);
        $DiasMartes=app(DiasHorarioController::class)->ObtenerDiasHorario('Martes',$id);
        $DiasMiercoles=app(DiasHorarioController::class)->ObtenerDiasHorario('Miercoles',$id);
        $DiasJueves=app(DiasHorarioController::class)->ObtenerDiasHorario('Jueves',$id);
        $DiasViernes=app(DiasHorarioController::class)->ObtenerDiasHorario('Viernes',$id);
        $DiasSabado=app(DiasHorarioController::class)->ObtenerDiasHorario('Sabado',$id);

        //Calcular horas Lunes
        if($DiasLunes->isEmpty()){
            $DiasLunes=null;
            $HorasTotalesLunes=0;
            $minutosTotalesLunes=0;
            $FloatminutosTotalesLunes=0;
        }
        else{
            $horaInicio=$DiasLunes[0]->HInicio;
            $horaFin=$DiasLunes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesLunes = $interval->h;
            $minutosTotalesLunes = $interval->i;
            $FloatminutosTotalesLunes=number_format($minutosTotalesLunes/6,0);
        }

        //Calcular horas martes
        if($DiasMartes->isEmpty()){
            $DiasMartes=null;
            $HorasTotalesMartes=0;
            $minutosTotalesMartes=0;
            $FloatminutosTotalesMartes=0;
        }
        else{
            $horaInicio=$DiasMartes[0]->HInicio;
            $horaFin=$DiasMartes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMartes = $interval->h;
            $minutosTotalesMartes = $interval->i;
            $FloatminutosTotalesMartes=number_format($minutosTotalesMartes/6,0);
        }

        //Calcular horas miercoles
        if($DiasMiercoles->isEmpty()){
            $DiasMiercoles=null;
            $HorasTotalesMiercoles=0;
            $minutosTotalesMiercoles=0;
            $FloatminutosTotalesMiercoles=0;
        }
        else{
            $horaInicio=$DiasMiercoles[0]->HInicio;
            $horaFin=$DiasMiercoles[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMiercoles = $interval->h;
            $minutosTotalesMiercoles = $interval->i;
            $FloatminutosTotalesMiercoles=number_format($minutosTotalesMiercoles/6,0);
        }

        //Calcular horas jueves
        if($DiasJueves->isEmpty()){
            $DiasJueves=null;
            $HorasTotalesJueves=0;
            $minutosTotalesJueves=0;
            $FloatminutosTotalesJueves=0;
        }
        else{
            $horaInicio=$DiasJueves[0]->HInicio;
            $horaFin=$DiasJueves[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesJueves = $interval->h;
            $minutosTotalesJueves = $interval->i;
            $FloatminutosTotalesJueves=number_format($minutosTotalesJueves/6,0);
        }


        //Calcular horas viernes
        if($DiasViernes->isEmpty()){
            $DiasViernes=null;
            $HorasTotalesViernes=0;
            $minutosTotalesViernes=0;
            $FloatminutosTotalesViernes=0;
        }
        else{
            $horaInicio=$DiasViernes[0]->HInicio;
            $horaFin=$DiasViernes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesViernes = $interval->h;
            $minutosTotalesViernes = $interval->i;
            $FloatminutosTotalesViernes=number_format($minutosTotalesViernes/6,0);
        }

        //Calcular horas sabado
        if($DiasSabado->isEmpty()){
            $DiasSabado=null;
            $HorasTotalesSabado=0;
            $minutosTotalesSabado=0;
            $FloatminutosTotalesSabado=0;
        }
        else{
            $horaInicio=$DiasSabado[0]->HInicio;
            $horaFin=$DiasSabado[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesSabado = $interval->h;
            $minutosTotalesSabado = $interval->i;
            $FloatminutosTotalesSabado=number_format($minutosTotalesSabado/6,0);
        }


        //Calcular horas totales
        //Sumar las horas y los minutos
        $total_horas = $HorasTotalesLunes + $HorasTotalesMartes+$HorasTotalesMiercoles+$HorasTotalesJueves+$HorasTotalesViernes+$HorasTotalesSabado;
        $total_minutos =$minutosTotalesLunes+$minutosTotalesMartes+$minutosTotalesMiercoles+$minutosTotalesJueves+$minutosTotalesViernes+$minutosTotalesSabado;

        // Ajustar los minutos si superan 59
        if ($total_minutos >= 60) {
            $total_minutos -= 60;
            $total_horas += 1;
        }

        $total_minutos=number_format($total_minutos/6,0);
        // $Materias=app(MateriasController::class)->ObtenerMaterias();
        // $Aulas=app(AulaController::class)->ObtenerAulas();
        // $Grupos=app(GruposController::class)->ObtenerGrupos();

        // $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        // $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        // $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        // $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        // $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);


        return inertia('Modulos/RH/Horarios/VistaHorario',[
            //INFORMACION NECESARIA PARA UN HORARIO
            'personal'=>$Personal,// INFORMACION DEL PERSONAL COMO NOMBRE,APELLDIOS,RFC,ESTUDIOS
            'periodo'=>$Periodo, // INFORMACION DE QUE PERIODO ES ESTE HORARIO
            'categoria'=>$Categoria,//INFORMACION SOBRE LA CATEGORIA COMO SU CLAVE O DESCRIPCION(PUESTO)
            'plaza'=>$Plaza,
            'DepartamentoAdscripcion'=>$DepartamentoAdscripcion,
            'EncargadoDepAdscripcion'=>$EncargadoDepAdscripcion,
            'DiaLunes'=>$DiasLunes,
            'DiaMartes'=>$DiasMartes,
            'DiaMiercoles'=>$DiasMiercoles,
            'DiaJueves'=>$DiasJueves,
            'DiaViernes'=>$DiasViernes,
            'DiaSabado'=>$DiasSabado,
            'HorasTotalesLunes'=>$HorasTotalesLunes,
            'minutosTotalesLunes'=>$FloatminutosTotalesLunes,
            'HorasTotalesMartes'=>$HorasTotalesMartes,
            'minutosTotalesMartes'=>$FloatminutosTotalesMartes,
            'HorasTotalesMiercoles'=>$HorasTotalesMiercoles,
            'minutosTotalesMiercoles'=>$FloatminutosTotalesMiercoles,
            'HorasTotalesJueves'=>$HorasTotalesJueves,
            'minutosTotalesJueves'=>$FloatminutosTotalesJueves,
            'HorasTotalesViernes'=>$HorasTotalesViernes,
            'minutosTotalesViernes'=>$FloatminutosTotalesViernes,
            'HorasTotalesSabado'=>$HorasTotalesSabado,
            'minutosTotalesSabado'=>$FloatminutosTotalesSabado,
            'HorasSemana'=>$total_horas,
            'MinutosSemana'=>$total_minutos
            // 'infoHorario'=>$InfoHorario,
            // 'materias'=>$Materias,
            // 'aulas'=>$Aulas,
            // 'grupos'=>$Grupos,
            // 'idHorario'=>$id,
            // 'ClasesLunes'=>$ClasesLunes,
            // 'ClasesMartes'=>$ClasesMartes,
            // 'ClasesMiercoles'=>$ClasesMiercoles,
            // 'ClasesJueves'=>$ClasesJueves,
            // 'ClasesViernes'=>$ClasesViernes,
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


    public function FormatoPDF(String $id){

        $Horario=horariosDocentes::find($id);

        $idPersonal=$Horario->idProfesor;
        $idPeriodo=$Horario->idPeriodo;
        $Personal=app(PersonalController::class)->ObtenerPersonalPorID($idPersonal);
        $Periodo=app(PeriodoController::class)->ObtenerPeriodoPorID($idPeriodo);

        //COMPROBAR SI TIENE UNA PLAZA
        if($Personal->idPlaza!=null){
            //OBTENER INFORMACION DE LA PLAZA Y SU CATEGORIA
            $Plaza=app(PlazaController::class)->ObtenerPlazaPorID($Personal->idPlaza);
            $Categoria=app(CategoriaController::class)->ObtenerCategoriaPorID($Plaza->idCategoria);

        }
        else{
            //SI NO TIENE PLAZA
            $Plaza=null;
            $Categoria=null;
        }

        $DepartamentoAdscripcion=app(DepartamentoController::class)->ObtenerDepartamentoPorID($Personal->idDepAdscripcion);

        if($DepartamentoAdscripcion->idEncargado!=null){
            $EncargadoDepAdscripcion=app(PersonalController::class)->ObtenerPersonalPorID($DepartamentoAdscripcion->idEncargado);
        }
        else{
            $EncargadoDepAdscripcion=null;
        }
        $DiasLunes=app(DiasHorarioController::class)->ObtenerDiasHorario('Lunes',$id);
        $DiasMartes=app(DiasHorarioController::class)->ObtenerDiasHorario('Martes',$id);
        $DiasMiercoles=app(DiasHorarioController::class)->ObtenerDiasHorario('Miercoles',$id);
        $DiasJueves=app(DiasHorarioController::class)->ObtenerDiasHorario('Jueves',$id);
        $DiasViernes=app(DiasHorarioController::class)->ObtenerDiasHorario('Viernes',$id);
        $DiasSabado=app(DiasHorarioController::class)->ObtenerDiasHorario('Sabado',$id);

        //Calcular horas Lunes
        if($DiasLunes->isEmpty()){
            $DiasLunes=null;
            $HorasTotalesLunes=0;
            $minutosTotalesLunes=0;
            $FloatminutosTotalesLunes=0;
        }
        else{
            $horaInicio=$DiasLunes[0]->HInicio;
            $horaFin=$DiasLunes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesLunes = $interval->h;
            $minutosTotalesLunes = $interval->i;
            $FloatminutosTotalesLunes=number_format($minutosTotalesLunes/6,0);
        }

        //Calcular horas martes
        if($DiasMartes->isEmpty()){
            $DiasMartes=null;
            $HorasTotalesMartes=0;
            $minutosTotalesMartes=0;
            $FloatminutosTotalesMartes=0;
        }
        else{
            $horaInicio=$DiasMartes[0]->HInicio;
            $horaFin=$DiasMartes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMartes = $interval->h;
            $minutosTotalesMartes = $interval->i;
            $FloatminutosTotalesMartes=number_format($minutosTotalesMartes/6,0);
        }

        //Calcular horas miercoles
        if($DiasMiercoles->isEmpty()){
            $DiasMiercoles=null;
            $HorasTotalesMiercoles=0;
            $minutosTotalesMiercoles=0;
            $FloatminutosTotalesMiercoles=0;
        }
        else{
            $horaInicio=$DiasMiercoles[0]->HInicio;
            $horaFin=$DiasMiercoles[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesMiercoles = $interval->h;
            $minutosTotalesMiercoles = $interval->i;
            $FloatminutosTotalesMiercoles=number_format($minutosTotalesMiercoles/6,0);
        }

        //Calcular horas jueves
        if($DiasJueves->isEmpty()){
            $DiasJueves=null;
            $HorasTotalesJueves=0;
            $minutosTotalesJueves=0;
            $FloatminutosTotalesJueves=0;
        }
        else{
            $horaInicio=$DiasJueves[0]->HInicio;
            $horaFin=$DiasJueves[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesJueves = $interval->h;
            $minutosTotalesJueves = $interval->i;
            $FloatminutosTotalesJueves=number_format($minutosTotalesJueves/6,0);
        }


        //Calcular horas viernes
        if($DiasViernes->isEmpty()){
            $DiasViernes=null;
            $HorasTotalesViernes=0;
            $minutosTotalesViernes=0;
            $FloatminutosTotalesViernes=0;
        }
        else{
            $horaInicio=$DiasViernes[0]->HInicio;
            $horaFin=$DiasViernes[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesViernes = $interval->h;
            $minutosTotalesViernes = $interval->i;
            $FloatminutosTotalesViernes=number_format($minutosTotalesViernes/6,0);
        }

        //Calcular horas sabado
        if($DiasSabado->isEmpty()){
            $DiasSabado=null;
            $HorasTotalesSabado=0;
            $minutosTotalesSabado=0;
            $FloatminutosTotalesSabado=0;
        }
        else{
            $horaInicio=$DiasSabado[0]->HInicio;
            $horaFin=$DiasSabado[0]->HFin;
            $horaInicio = new DateTime($horaInicio);
            $horaFin = new DateTime($horaFin);
            $interval = $horaInicio->diff($horaFin);
            $HorasTotalesSabado = $interval->h;
            $minutosTotalesSabado = $interval->i;
            $FloatminutosTotalesSabado=number_format($minutosTotalesSabado/6,0);
        }


        //Calcular horas totales
        //Sumar las horas y los minutos
        $total_horas = $HorasTotalesLunes + $HorasTotalesMartes+$HorasTotalesMiercoles+$HorasTotalesJueves+$HorasTotalesViernes+$HorasTotalesSabado;
        $total_minutos =$minutosTotalesLunes+$minutosTotalesMartes+$minutosTotalesMiercoles+$minutosTotalesJueves+$minutosTotalesViernes+$minutosTotalesSabado;

        // Ajustar los minutos si superan 59
        if ($total_minutos >= 60) {
            $total_minutos -= 60;
            $total_horas += 1;
        }

        $total_minutos=number_format($total_minutos/6,0);
        // $Materias=app(MateriasController::class)->ObtenerMaterias();
        // $Aulas=app(AulaController::class)->ObtenerAulas();
        // $Grupos=app(GruposController::class)->ObtenerGrupos();

        // $ClasesLunes=app(ClasesController::class)->ObtenerClasesDia('Lunes',$id);
        // $ClasesMartes=app(ClasesController::class)->ObtenerClasesDia('Martes',$id);
        // $ClasesMiercoles=app(ClasesController::class)->ObtenerClasesDia('Miercoles',$id);
        // $ClasesJueves=app(ClasesController::class)->ObtenerClasesDia('Jueves',$id);
        // $ClasesViernes=app(ClasesController::class)->ObtenerClasesDia('Viernes',$id);


        return inertia('Modulos/RH/Horarios/FormatoPDFHorarios',[
            //INFORMACION NECESARIA PARA UN HORARIO
            'personal'=>$Personal,// INFORMACION DEL PERSONAL COMO NOMBRE,APELLDIOS,RFC,ESTUDIOS
            'periodo'=>$Periodo, // INFORMACION DE QUE PERIODO ES ESTE HORARIO
            'categoria'=>$Categoria,//INFORMACION SOBRE LA CATEGORIA COMO SU CLAVE O DESCRIPCION(PUESTO)
            'plaza'=>$Plaza,
            'DepartamentoAdscripcion'=>$DepartamentoAdscripcion,
            'EncargadoDepAdscripcion'=>$EncargadoDepAdscripcion,
            'DiaLunes'=>$DiasLunes,
            'DiaMartes'=>$DiasMartes,
            'DiaMiercoles'=>$DiasMiercoles,
            'DiaJueves'=>$DiasJueves,
            'DiaViernes'=>$DiasViernes,
            'DiaSabado'=>$DiasSabado,
            'HorasTotalesLunes'=>$HorasTotalesLunes,
            'minutosTotalesLunes'=>$FloatminutosTotalesLunes,
            'HorasTotalesMartes'=>$HorasTotalesMartes,
            'minutosTotalesMartes'=>$FloatminutosTotalesMartes,
            'HorasTotalesMiercoles'=>$HorasTotalesMiercoles,
            'minutosTotalesMiercoles'=>$FloatminutosTotalesMiercoles,
            'HorasTotalesJueves'=>$HorasTotalesJueves,
            'minutosTotalesJueves'=>$FloatminutosTotalesJueves,
            'HorasTotalesViernes'=>$HorasTotalesViernes,
            'minutosTotalesViernes'=>$FloatminutosTotalesViernes,
            'HorasTotalesSabado'=>$HorasTotalesSabado,
            'minutosTotalesSabado'=>$FloatminutosTotalesSabado,
            'HorasSemana'=>$total_horas,
            'MinutosSemana'=>$total_minutos
            // 'infoHorario'=>$InfoHorario,
            // 'materias'=>$Materias,
            // 'aulas'=>$Aulas,
            // 'grupos'=>$Grupos,
            // 'idHorario'=>$id,
            // 'ClasesLunes'=>$ClasesLunes,
            // 'ClasesMartes'=>$ClasesMartes,
            // 'ClasesMiercoles'=>$ClasesMiercoles,
            // 'ClasesJueves'=>$ClasesJueves,
            // 'ClasesViernes'=>$ClasesViernes,
        ]);
    }


    function HorarioConcentrado(String $idPeriodo){

        //Obtener todos los horarios de los docentes en el periodo seleccionado
        $ListaHorarios=horariosDocentes::where('idPeriodo',$idPeriodo)->get();
        $numeroDeHorarios = $ListaHorarios->count();
        //INFORMACION NECESARIA PARA EL HORARIO
        $ListaPersonal=[];
        $Periodo=app(PeriodoController::class)->ObtenerPeriodoPorID($idPeriodo); //El periodo sera el mismo en todos los horarios
        $ListaCategorias=[];
        $ListaPlazas=[];
        $ListaDepartamentoAdscripcion=[];
        $ListaEncargadoDepAdscripcion=[];
        //Lunes
        $ListaDiasLunes=[];
        $ListaHorasTotalesLunes=[];
        $ListaminutosTotalesLunes=[];
        $ListaFloatminutosTotalesLunes=[];
        //Martes
        $ListaDiasMartes=[];
        $ListaHorasTotalesMartes=[];
        $ListaminutosTotalesMartes=[];
        $ListaFloatminutosTotalesMartes=[];
        //Miercoles
        $ListaDiasMiercoles=[];
        $ListaHorasTotalesMiercoles=[];
        $ListaminutosTotalesMiercoles=[];
        $ListaFloatminutosTotalesMiercoles=[];
        //Jueves
        $ListaDiasJueves=[];
        $ListaHorasTotalesJueves=[];
        $ListaminutosTotalesJueves=[];
        $ListaFloatminutosTotalesJueves=[];
        //Viernes
        $ListaDiasViernes=[];
        $ListaHorasTotalesViernes=[];
        $ListaminutosTotalesViernes=[];
        $ListaFloatminutosTotalesViernes=[];
        //Sabado
        $ListaDiasSabado=[];
        $ListaHorasTotalesSabado=[];
        $ListaminutosTotalesSabado=[];
        $ListaFloatminutosTotalesSabado=[];

        //Horas Semana
        $Listatotal_horas=[];
        $Listatotal_minutos=[];


        // if($ListaHorarios->count()!=0){

            //Recorrer lista de horarios
            foreach($ListaHorarios as $Horario){

                //Obtener ID del horario
                $idHorario=$Horario->id;

                //Obtener de quien es el horario
                $idPersonal=$Horario->idProfesor;
                $Personal=app(PersonalController::class)->ObtenerPersonalPorID($idPersonal);
                array_push($ListaPersonal,$Personal); //Agregarlo a la lista

                //COMPROBAR SI TIENE UNA PLAZA
                if($Personal->idPlaza!=null){
                    //OBTENER INFORMACION DE LA PLAZA Y SU CATEGORIA
                    $Plaza=app(PlazaController::class)->ObtenerPlazaPorID($Personal->idPlaza);
                    $Categoria=app(CategoriaController::class)->ObtenerCategoriaPorID($Plaza->idCategoria);

                    array_push($ListaPlazas,$Plaza); //Agregarlo a la lista
                    array_push($ListaCategorias,$Categoria);//Agregarlo a la lista
                }
                else{
                    //SI NO TIENE PLAZA
                    $Plaza=null;
                    $Categoria=null;
                    array_push($ListaPlazas,$Plaza); //Agregarlo a la lista
                    array_push($ListaCategorias,$Categoria);//Agregarlo a la lista
                }


                $DepartamentoAdscripcion=app(DepartamentoController::class)->ObtenerDepartamentoPorID($Personal->idDepAdscripcion);
                array_push($ListaDepartamentoAdscripcion,$DepartamentoAdscripcion);

                if($DepartamentoAdscripcion->idEncargado!=null){
                    $EncargadoDepAdscripcion=app(PersonalController::class)->ObtenerPersonalPorID($DepartamentoAdscripcion->idEncargado);
                    array_push($ListaEncargadoDepAdscripcion,$EncargadoDepAdscripcion);
                }
                else{
                    $EncargadoDepAdscripcion=null;
                    array_push($ListaEncargadoDepAdscripcion,$EncargadoDepAdscripcion);
                }

                //OBTENER DIAS EN BASE AL ID HORARIO
                $DiasLunes=app(DiasHorarioController::class)->ObtenerDiasHorario('Lunes',$idHorario);
                $DiasMartes=app(DiasHorarioController::class)->ObtenerDiasHorario('Martes',$idHorario);
                $DiasMiercoles=app(DiasHorarioController::class)->ObtenerDiasHorario('Miercoles',$idHorario);
                $DiasJueves=app(DiasHorarioController::class)->ObtenerDiasHorario('Jueves',$idHorario);
                $DiasViernes=app(DiasHorarioController::class)->ObtenerDiasHorario('Viernes',$idHorario);
                $DiasSabado=app(DiasHorarioController::class)->ObtenerDiasHorario('Sabado',$idHorario);

                //Calcular horas Lunes
                if($DiasLunes->isEmpty()){
                    $DiasLunes=null;
                    $HorasTotalesLunes=0;
                    $minutosTotalesLunes=0;
                    $FloatminutosTotalesLunes=0;
                    array_push($ListaDiasLunes,$DiasLunes);
                    array_push($ListaHorasTotalesLunes,$HorasTotalesLunes);
                    array_push($ListaminutosTotalesLunes,$minutosTotalesLunes);
                    array_push($ListaFloatminutosTotalesLunes,$FloatminutosTotalesLunes);
                }
                else{
                    $horaInicio=$DiasLunes[0]->HInicio;
                    $horaFin=$DiasLunes[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesLunes = $interval->h;
                    $minutosTotalesLunes = $interval->i;
                    $FloatminutosTotalesLunes=number_format($minutosTotalesLunes/6,0);

                    array_push($ListaDiasLunes,$DiasLunes);
                    array_push($ListaHorasTotalesLunes,$HorasTotalesLunes);
                    array_push($ListaminutosTotalesLunes,$minutosTotalesLunes);
                    array_push($ListaFloatminutosTotalesLunes,$FloatminutosTotalesLunes);
                }

                //Calcular horas Martes
                if($DiasMartes->isEmpty()){
                    $DiasMartes=null;
                    $HorasTotalesMartes=0;
                    $minutosTotalesMartes=0;
                    $FloatminutosTotalesMartes=0;
                    array_push($ListaDiasMartes,$DiasMartes);
                    array_push($ListaHorasTotalesMartes,$HorasTotalesMartes);
                    array_push($ListaminutosTotalesMartes,$minutosTotalesMartes);
                    array_push($ListaFloatminutosTotalesMartes,$FloatminutosTotalesMartes);
                }
                else{
                    $horaInicio=$DiasMartes[0]->HInicio;
                    $horaFin=$DiasMartes[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesMartes = $interval->h;
                    $minutosTotalesMartes = $interval->i;
                    $FloatminutosTotalesMartes=number_format($minutosTotalesMartes/6,0);

                    array_push($ListaDiasMartes,$DiasMartes);
                    array_push($ListaHorasTotalesMartes,$HorasTotalesMartes);
                    array_push($ListaminutosTotalesMartes,$minutosTotalesMartes);
                    array_push($ListaFloatminutosTotalesMartes,$FloatminutosTotalesMartes);
                }

                //Calcular horas Miercoles
                if($DiasMiercoles->isEmpty()){
                    $DiasMiercoles=null;
                    $HorasTotalesMiercoles=0;
                    $minutosTotalesMiercoles=0;
                    $FloatminutosTotalesMiercoles=0;
                    array_push($ListaDiasMiercoles,$DiasMiercoles);
                    array_push($ListaHorasTotalesMiercoles,$HorasTotalesMiercoles);
                    array_push($ListaminutosTotalesMiercoles,$minutosTotalesMiercoles);
                    array_push($ListaFloatminutosTotalesMiercoles,$FloatminutosTotalesMiercoles);
                }
                else{
                    $horaInicio=$DiasMiercoles[0]->HInicio;
                    $horaFin=$DiasMiercoles[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesMiercoles = $interval->h;
                    $minutosTotalesMiercoles = $interval->i;
                    $FloatminutosTotalesMiercoles=number_format($minutosTotalesMiercoles/6,0);

                    array_push($ListaDiasMiercoles,$DiasMiercoles);
                    array_push($ListaHorasTotalesMiercoles,$HorasTotalesMiercoles);
                    array_push($ListaminutosTotalesMiercoles,$minutosTotalesMiercoles);
                    array_push($ListaFloatminutosTotalesMiercoles,$FloatminutosTotalesMiercoles);
                }

                //Calcular horas Jueves
                if($DiasJueves->isEmpty()){
                    $DiasJueves=null;
                    $HorasTotalesJueves=0;
                    $minutosTotalesJueves=0;
                    $FloatminutosTotalesJueves=0;
                    array_push($ListaDiasJueves,$DiasJueves);
                    array_push($ListaHorasTotalesJueves,$HorasTotalesJueves);
                    array_push($ListaminutosTotalesJueves,$minutosTotalesJueves);
                    array_push($ListaFloatminutosTotalesJueves,$FloatminutosTotalesJueves);
                }
                else{
                    $horaInicio=$DiasJueves[0]->HInicio;
                    $horaFin=$DiasJueves[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesJueves = $interval->h;
                    $minutosTotalesJueves = $interval->i;
                    $FloatminutosTotalesJueves=number_format($minutosTotalesJueves/6,0);

                    array_push($ListaDiasJueves,$DiasJueves);
                    array_push($ListaHorasTotalesJueves,$HorasTotalesJueves);
                    array_push($ListaminutosTotalesJueves,$minutosTotalesJueves);
                    array_push($ListaFloatminutosTotalesJueves,$FloatminutosTotalesJueves);
                }

                //Calcular horas Viernes
                if($DiasViernes->isEmpty()){
                    $DiasViernes=null;
                    $HorasTotalesViernes=0;
                    $minutosTotalesViernes=0;
                    $FloatminutosTotalesViernes=0;
                    array_push($ListaDiasViernes,$DiasViernes);
                    array_push($ListaHorasTotalesViernes,$HorasTotalesViernes);
                    array_push($ListaminutosTotalesViernes,$minutosTotalesViernes);
                    array_push($ListaFloatminutosTotalesViernes,$FloatminutosTotalesViernes);
                }
                else{
                    $horaInicio=$DiasViernes[0]->HInicio;
                    $horaFin=$DiasViernes[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesViernes = $interval->h;
                    $minutosTotalesViernes = $interval->i;
                    $FloatminutosTotalesViernes=number_format($minutosTotalesViernes/6,0);

                    array_push($ListaDiasViernes,$DiasViernes);
                    array_push($ListaHorasTotalesViernes,$HorasTotalesViernes);
                    array_push($ListaminutosTotalesViernes,$minutosTotalesViernes);
                    array_push($ListaFloatminutosTotalesViernes,$FloatminutosTotalesViernes);
                }

                //Calcular horas Sabado
                if($DiasSabado->isEmpty()){
                    $DiasSabado=null;
                    $HorasTotalesSabado=0;
                    $minutosTotalesSabado=0;
                    $FloatminutosTotalesSabado=0;
                    array_push($ListaDiasSabado,$DiasSabado);
                    array_push($ListaHorasTotalesSabado,$HorasTotalesSabado);
                    //array_push($ListaminutosTotalesSabado,$minutosTotalesSabado);
                    array_push($ListaFloatminutosTotalesSabado,$FloatminutosTotalesSabado);
                }
                else{
                    $horaInicio=$DiasSabado[0]->HInicio;
                    $horaFin=$DiasSabado[0]->HFin;
                    $horaInicio = new DateTime($horaInicio);
                    $horaFin = new DateTime($horaFin);
                    $interval = $horaInicio->diff($horaFin);
                    $HorasTotalesSabado = $interval->h;
                    $minutosTotalesSabado = $interval->i;
                    $FloatminutosTotalesSabado=number_format($minutosTotalesSabado/6,0);

                    array_push($ListaDiasSabado,$DiasSabado);
                    array_push($ListaHorasTotalesSabado,$HorasTotalesSabado);
                    //array_push($ListaminutosTotalesSabado,$minutosTotalesSabado);
                    array_push($ListaFloatminutosTotalesSabado,$FloatminutosTotalesSabado);
                }

                //Calcular horas totales
                //Sumar las horas y los minutos
                $total_horas = $HorasTotalesLunes + $HorasTotalesMartes+$HorasTotalesMiercoles+$HorasTotalesJueves+$HorasTotalesViernes+$HorasTotalesSabado;
                $total_minutos =$minutosTotalesLunes+$minutosTotalesMartes+$minutosTotalesMiercoles+$minutosTotalesJueves+$minutosTotalesViernes+$minutosTotalesSabado;

                // Ajustar los minutos si superan 59
                if ($total_minutos >= 60) {
                    $total_minutos -= 60;
                    $total_horas += 1;
                }

                $total_minutos=number_format($total_minutos/6,0);

                array_push($Listatotal_horas,$total_horas);
                array_push($Listatotal_minutos,$total_minutos);
            // }
        }

        return inertia('Modulos/RH/Horarios/HorarioConcentrado',[
            'ListaHorarios'=>$ListaHorarios,
            'Listapersonal'=>$ListaPersonal,
            'periodo'=>$Periodo,
            'Listacategoria'=>$ListaCategorias,
            'Listaplaza'=>$ListaPlazas,
            'ListaDepartamentoAdscripcion'=>$ListaDepartamentoAdscripcion,
            'ListaEncargadoDepAdscripcion'=>$ListaEncargadoDepAdscripcion,
            'ListaDiaLunes'=>$ListaDiasLunes,
            'ListaDiaMartes'=>$ListaDiasMartes,
            'ListaDiaMiercoles'=>$ListaDiasMiercoles,
            'ListaDiaJueves'=>$ListaDiasJueves,
            'ListaDiaViernes'=>$ListaDiasViernes,
            'ListaDiaSabado'=>$ListaDiasSabado,
            'ListaHorasTotalesLunes'=>$ListaHorasTotalesLunes,
            'ListaminutosTotalesLunes'=>$ListaFloatminutosTotalesLunes,
            'ListaHorasTotalesMartes'=>$ListaHorasTotalesMartes,
            'ListaminutosTotalesMartes'=>$ListaFloatminutosTotalesMartes,
            'ListaHorasTotalesMiercoles'=>$ListaHorasTotalesMiercoles,
            'ListaminutosTotalesMiercoles'=>$ListaFloatminutosTotalesMiercoles,
            'ListaHorasTotalesJueves'=>$ListaHorasTotalesJueves,
            'ListaminutosTotalesJueves'=>$ListaFloatminutosTotalesJueves,
            'ListaHorasTotalesViernes'=>$ListaHorasTotalesViernes,
            'ListaminutosTotalesViernes'=>$ListaFloatminutosTotalesViernes,
            'ListaHorasTotalesSabado'=>$ListaHorasTotalesSabado,
            'ListaminutosTotalesSabado'=>$ListaFloatminutosTotalesSabado,
            'ListaHorasSemana'=>$Listatotal_horas,
            'ListaMinutosSemana'=>$Listatotal_minutos,
            'numHorarios'=>$numeroDeHorarios

        ]);
    }

    public function buscarHorario(Request $request){

        //$departamento = $request->input('departamentoBuscar');
        $Personal=$request->input('PersonalBuscar');
        $Periodo=$request->input('periodoBuscar');
        $Departamento=$request->input('departamentoBuscar');

        if($Personal==0 && $Periodo==0 && $Departamento==0){
            $Horarios=[];
        }
        else if($Personal==0 && $Periodo==0){
                                                //Tabla unir  --Especificar llaves foraneas con que se une
            $Horarios = horariosDocentes::join('personal', 'horarios_docentes.idProfesor', '=', 'personal.id')
            ->where('personal.idDepAdscripcion', '=', $Departamento) //Busqueda dentro de la tabla que se unio
            ->get();
        }
        else if($Personal==0){
            $Horarios=horariosDocentes::where('idPeriodo','=',$Periodo)->get();
        }
        else if($Periodo==0){
            $Horarios=horariosDocentes::where('idProfesor','=',$Personal)->get();
        }else{

            $Horarios=horariosDocentes::where('idProfesor','=',$Personal)->
            where('idPeriodo','=',$Periodo)->get();
        }
        return $Horarios;

    }

}
