<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class MateriasController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only('index');
        $this->middleware(['role:Administrador'])->only('store');
    $this->middleware(['role:Administrador'])->only('edit','update');
        $this->middleware(['role:Administrador'])->only('destroy');
    }


    public function index(){

        $Pagination=Materias::paginate(10);

        $Materias=$Pagination->items();
        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return inertia::render('Modulos/RH/Materias/Materias',[
            'materias'=>$Materias,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }

    public function store(Request $request){
        $Materia=new Materias();

        try{
            $Materia->Nombre=$request->Nombre;
            $Materia->Descripcion=$request->Descripcion;
            $Materia->Codigo=$request->Codigo;

            $Materia->save();
            Session::flash('mensaje', 'Materia registrada correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Materias.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al registrar la materia');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Materias.index');
        }
    }

    public function edit(String $id){
        $Materia = Materias::find($id);
        return Inertia::render ('Modulos/RH/Materias/formEditarMateria',[
            'materia'=>$Materia,
        ]);
    }

    public function update(Request $request, String $id){

        try{
            $Materia=Materias::find($id);

            $Materia->update($request->all());
            Session::flash('mensaje', 'Se ha guardado los cambios');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Materias.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al intentar actualizar los datos del usuario');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Materias.index');
        }
    }

    public function destroy(String $id){
        try{
            $Materia = Materias::find($id);
            $Materia->delete();
            Session::flash('mensaje', 'Se ha eliminado correctamente la materia '.$Materia->Nombre);
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('Materias.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al eliminar la materia '.$Materia->Nombre);
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Materias.index');
        }
    }

    public function buscar(Request $request){
        $materia=$request->input('materia');
        $campo = $request->input('campo');
        $result=Materias::where($campo, 'LIKE', '%'.$materia.'%')->get();

        return $result;
    }

    public function ObtenerMaterias(){
        $Materias=Materias::all();
        return $Materias;
    }
}
