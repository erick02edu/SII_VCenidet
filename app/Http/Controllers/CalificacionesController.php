<?php

namespace App\Http\Controllers;

use App\Models\Calificaciones;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Alumnos;

class CalificacionesController extends Controller
{

    public function index(){
        $ListaMaterias=app(MateriasController::class)->ObtenerMaterias();
        $ListaGrupos=app(GruposController::class)->ObtenerGrupos();
        $ListaPeriodos=app(PeriodoController::class)->ObtenerPeriodos();
        return Inertia::render ('Modulos/Serv_Escolares/Calificaciones/Calificaciones',[
            'materias'=>$ListaMaterias,
            'grupos'=>$ListaGrupos,
            'periodos'=>$ListaPeriodos
        ]);

    }

    public function subirCalificaciones(Request $request)
    {
        $listaCalificaciones = $request->input('ListaCalificaciones');
        $listaIDAlumnos = $request->input('ListaIDAlumnos');
        $materia = $request->input('Materia');
        $Idgrupo = $request->input('grupo');


        $InfoGrupo=app(GruposController::class)->ObtenerGrupoPorID($Idgrupo);
        $semestre=$InfoGrupo->Semestre;
        $i=0;



        foreach ($listaIDAlumnos as $alumno) {


            $Calificacion=new Calificaciones();

            $Calificacion->idAlumno=$alumno;
            $Calificacion->idMateria=$materia;
            $Calificacion->Calificacion=$listaCalificaciones[$i];
            $Calificacion->NumSemestre=$semestre;
            $Calificacion->idProfesor=null;
            $Calificacion->idGrupo=$Idgrupo;
            $i++;

            //dd($Calificacion);
            $Calificacion->save();
        }


        return back();
    }

    public function ActualizarCalificaciones(Request $request){
        $listaCalificacionesNuevas= $request->input('ListaCalificaciones');
        // $listaIDAlumnos = $request->input('ListaIDAlumnos');

        $materia = $request->input('Materia');
        $Idgrupo = $request->input('grupo');

        $listaCalificacionesAntes=Calificaciones::
            where('idGrupo',$Idgrupo)->
            where('idMateria',$materia)
            ->get();

        $i=0;

        //return response()->json($listaCalificacionesAntes);

        foreach ($listaCalificacionesAntes as $Calificaciones) {
            $Calificaciones->Calificacion=$listaCalificacionesNuevas[$i];
            $Calificaciones->save();
            $i++;
        }




    }

    public function Buscar(Request $request){
        $Grupo=$request->input('Grupo');
        $Materia = $request->input('Materia');

        $listaCalificaciones=Calificaciones::
            where('idGrupo',$Grupo)->
            where('idMateria',$Materia)
            ->get('Calificacion');


        return $listaCalificaciones;

    }

    //Promedios

    public function Promedios(){

        $Pagination=Alumnos::paginate(10);
        $Alumnos=$Pagination->items();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        return Inertia::render ('Modulos/Serv_Escolares/Calificaciones/Promedios',[
            'alumnos'=>$Alumnos,
            'Paginator'=>$Pagination,
            'grupos'=>$Grupos,
        ]);
    }

    public function GenerarHistorial(Request $request){



        $tipoHistorial=$request->tipoHistorial;

        //INFORMACION A ENVIAR A LA VISTA
        $NombresAlumnos=[];
        $NumeroAlumnos=count($request->AlumnosSeleccionados);
        $NumSemestres=[];
        $CalificacionesTotales=[]; //Array de array
        $PromediosGenerales=[];




        foreach($request->AlumnosSeleccionados as $alumno){
                //Obtner nombre completo de alumno y agregarlo al array de NombresAlumnos
            $NombreAlumno=$alumno['Nombre'].' '.$alumno['ApellidoP'].' '.$alumno['ApellidoM'];
            array_push($NombresAlumnos,$NombreAlumno);
                //Obtener calificaciones del alumno


            if($tipoHistorial=='Especifico'){
                $Calificaciones=Calificaciones::
                where('idAlumno',$alumno['id'])
                ->where('NumSemestre',$request->NumSemestre)
                ->orderBy('NumSemestre', 'asc') //Ordenar por numero de semestre
                ->get(['Calificacion','idMateria','NumSemestre']);
            }

            else if($tipoHistorial=='General'){
                $Calificaciones=Calificaciones::
                where('idAlumno',$alumno['id'])
                ->orderBy('NumSemestre', 'asc') //Ordenar por numero de semestre
                ->get(['Calificacion','idMateria','NumSemestre']);
            }
            //Convertir en array e ingresarlo en el arreglo de calificaciones totales
            $Calificaciones=$Calificaciones->toArray();

            //dd($Calificaciones);
            array_push($CalificacionesTotales,$Calificaciones);



                //---OBTENER PROMEDIOS GENERALES--

                    $totalCalificaciones = 0;
                    $numeroCalificaciones = count($Calificaciones);


                    if($numeroCalificaciones>0){
                        // Sumar todas las calificaciones
                        foreach ($Calificaciones as $calificacion) {
                            $totalCalificaciones += $calificacion["Calificacion"];
                        }

                        // Calcular el promedio general

                        $promedioGeneral = $totalCalificaciones / $numeroCalificaciones;
                        // Redondear el promedio a dos cifras decimales
                        $promedioGeneral = round($promedioGeneral, 2);
                    }else{
                        $promedioGeneral=0;
                    }
                    array_push($PromediosGenerales,$promedioGeneral);

            //----OBTENER EL MAYOR SEMESTRE----
            $maxSemestre = null;

            // Iterar sobre el array
            foreach ($Calificaciones as $Calificacion) {
                // Obtener el número de semestre actual
                $ActualSemestre = $Calificacion['NumSemestre'];

                // Actualizar $maxSemestre si el número de semestre actual es mayor
                if ($maxSemestre === null || $ActualSemestre > $maxSemestre) {
                    $maxSemestre = (int)$ActualSemestre;
                }
            }

            array_push($NumSemestres,$maxSemestre);
            }



            $ListaMaterias=app(MateriasController::class)->ObtenerMaterias();

            return Inertia::render ('Modulos/Serv_Escolares/Calificaciones/HistorialAlumnos',[
                'NombreAlumnos'=>$NombresAlumnos,
                'NumeroAlumnos'=>$NumeroAlumnos,
                'NumSemestres'=>$NumSemestres,
                'CalificacionesTotales'=>$CalificacionesTotales,
                'materias'=>$ListaMaterias,
                'PromediosGenerales'=>$PromediosGenerales,
            ]);











    }

}













