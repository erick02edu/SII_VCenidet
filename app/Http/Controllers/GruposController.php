<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use App\Models\Periodos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Exception;


class GruposController extends Controller
{

    public function index()
    {
        $Pagination=Grupos::paginate(10);
        $Grupos=$Pagination->items();
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();
        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/Serv_Escolares/Grupos/Grupos',[
            'grupos'=>$Grupos,
            'Paginator'=>$Pagination,
            'periodos'=>$Periodos,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }

    public function store(Request $request)
    {
        $Grupo=new Grupos();
        try{
        $Grupo->Semestre=$request->Semestre;
        $Grupo->Especialidad=$request->Especialidad;
        $Grupo->Letra=$request->Letra;
        $Grupo->idPeriodo=$request->idPeriodo;
        $Grupo->save();

        Session::flash('mensaje', 'Se ha registrado el grupo correctamente');
        Session::flash('TipoMensaje', 'Exitoso');
        return Redirect::route('Grupos.index');
    }
    catch(Exception $e){
        Session::flash('mensaje', 'Ha ocurrido un error al registrar el grupo');
        Session::flash('TipoMensaje', 'Error');
        return Redirect::route('Grupos.index');
    }

    }

    public function edit(string $id)
    {
        $Grupo = Grupos::find($id);
        $Periodos=app(PeriodoController::class)->ObtenerPeriodos();



        return Inertia::render ('Modulos/Serv_Escolares/Grupos/formEditarGrupos',[
            'grupo'=>$Grupo,
            'periodos'=>$Periodos
        ]);
    }

    public function update(Request $request, string $id)
    {
        try{
            $Grupo=Grupos::find($id);
            $Grupo->update($request->all());

            Session::flash('mensaje', 'Se ha guardado los cambios');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Grupos.index');
            }
            catch(Exception $e){
                Session::flash('mensaje', 'Ha ocurrido un error al intentar actualizar los datos del usuario');
                Session::flash('TipoMensaje', 'Error');
                return redirect::route('Grupos.index');
            }
    }

    public function destroy(string $id)
    {
        try{
            $Grupo= Grupos::find($id);
            $Grupo->delete();

            Session::flash('mensaje', 'Se ha eliminado correctamente al grupo');
            Session::flash('TipoMensaje', 'Exitoso');

            return Redirect::route('Grupos.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al eliminar al usuario');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Grupos.index');
        }
    }

    public function Buscar(Request $request){
        $Grupo=$request->input('grupo');

        $campo = $request->input('campo');

        $result=Grupos::where($campo, 'LIKE', '%'.$Grupo.'%')->get();
        return $result;
    }


    public function EditarAlumnos(String $id){
        $Grupo=Grupos::find($id);

        $PeriodoGrupo=app(PeriodoController::class)->ObtenerPeriodoPorID($Grupo->idPeriodo);
        $AlumnosGrupo=app(AlumnosController::class)->AlumnosPorGrupo($id);

        $AlumnosSinGrupo=app(AlumnosController::class)->BuscarAlumnosSinGrupo();

        return Inertia::render ('Modulos/Serv_Escolares/Grupos/AsignarAlumnos',[
            'grupo'=>$Grupo,
            'periodo'=>$PeriodoGrupo,
            'alumnos'=>$AlumnosGrupo,
            'alumnosSinGrupo'=>$AlumnosSinGrupo
        ]);
    }

    public function ObtenerGrupos(){
        $Grupos=Grupos::all();
        return $Grupos;
    }

    public function ObtenerGruposPorPeriodo($idPeriodo){
        $Grupos=Grupos::where('idPeriodo',$idPeriodo)->get();
        return $Grupos;
    }


    public function ObtenerGrupoPorID(String $id)
    {
        $Grupo=Grupos::find($id);
        return $Grupo;
    }
}
