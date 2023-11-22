<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AlumnosController extends Controller
{
    public function index(){

        $Pagination=Alumnos::paginate(10);
        $Alumnos=$Pagination->items();
        $Grupos=app(GruposController::class)->ObtenerGrupos();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');


        return Inertia::render('Modulos/Serv_Escolares/Alumnos/Alumnos',[
            'alumnos'=>$Alumnos,
            'Paginator'=>$Pagination,
            'grupos'=>$Grupos,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }

    public function store(Request $request){
        $Alumno=new Alumnos();
        try{

            $Alumno->Nombre=$request->Nombre;
            $Alumno->ApellidoP=$request->ApellidoP;
            $Alumno->ApellidoM=$request->ApellidoM;
            $Alumno->FechaNac=$request->FechaNacimiento;
            $Alumno->noControl=$request->numControl;
            $Alumno->curp=$request->curp;
            $Alumno->Direccion=$request->Direccion;
            $Alumno->Genero=$request->Genero;
            $Alumno->Telefono=$request->Telefono;
            $Alumno->idGrupo=$request->idGrupo;

            $Alumno->save();

            Session::flash('mensaje', 'Se ha registrado el alumno correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Alumnos.index');
        }catch(Exception $e){
            //return response()->json(['error'=>$e]);
            Session::flash('mensaje', 'Ha ocurrido un error al registrar el alumno');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Alumnos.index');
        }
    }

    public function edit(String $id){
        $Alumno=Alumnos::find($id);

        if($Alumno->idGrupo!=null){
            $GrupoEditar=app(GruposController::class)->ObtenerGrupoPorID($Alumno->idGrupo);
        }
        else{
            $GrupoEditar=null;
        }
            $ListaGrupos=app(GruposController::class)->ObtenerGrupos();

        return Inertia::render ('Modulos/Serv_Escolares/Alumnos/formEditarAlumnos',[
            'alumno'=>$Alumno,
            'GrupoEditar'=>$GrupoEditar,
            'ListaGrupos'=>$ListaGrupos,
        ]);
    }


    public function update(String $id,Request $request){
        try{
            $Alumno=Alumnos::find($id);

            $Alumno->update($request->all());
            Session::flash('mensaje', 'Se guardado los cambios correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Alumnos.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al guardar los cambios');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Alumnos.index');
        }
    }

    public function destroy(String $id){
        try{
            $Alumno = Alumnos::find($id);
            $Alumno->delete();
            Session::flash('mensaje', 'Se eliminado al alumno correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('Alumnos.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ocurrio un error al eliminar la plaza');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Alumnos.index');
        }
    }

    public function Buscar(Request $request){
        $Alumno=$request->input('Alumno');
        $campo = $request->input('campo');
        $result=[];

        if ($request->has('Grupo')) {


            if($campo=='Nombre'){
                $result=Alumnos::
                whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Alumno.'%'])->
                whereNull('idGrupo')->get();
            }
            else{
                $result=Alumnos::where($campo, 'LIKE', '%'.$Alumno.'%')->
                whereNull('idGrupo')->get();
            }

        }
        else{
            if($campo=='Nombre'){
                $result=Alumnos::
                whereRaw("CONCAT(Nombre,' ',ApellidoP,' ',ApellidoM) LIKE ?",['%'.$Alumno.'%'])->get();
            }
            else{
                $result=Alumnos::where($campo, 'LIKE', '%'.$Alumno.'%')->get();
            }
        }


        return $result;

    }

    public function AsignarGrupo(Request $request){
        //return response()->json(['Info enviada'=>$request->AlumnosSeleccionados]);
        $ListaAlumnos=$request->AlumnosSeleccionados;
        $idGrupo=$request->idGrupo;

        foreach ($ListaAlumnos as $idAlumno) {
            $Alumno=Alumnos::find($idAlumno);

            $Alumno->idGrupo=$idGrupo;
            $Alumno->save();
        }

        return back();


    }

    public function AlumnosPorGrupo(String $id){
        $result=Alumnos::where('idGrupo',$id)->get();
        return $result;
    }

    public function BuscarAlumnosSinGrupo(){
        $result = Alumnos::whereNull('idGrupo')->get();
        return $result;
    }

    public function QuitarGrupo(String $id){
        $Alumno=Alumnos::find($id);
        $Alumno->idGrupo=null;
        $Alumno->save();
        return back();
    }
}
