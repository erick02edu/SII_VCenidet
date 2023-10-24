<?php

namespace App\Http\Controllers;

use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonalController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver informacion del personal|Agregar Personal|Asignar cuentas de usuarios al personal|Asignar Plazas al personal|Editar información del personal|Eliminar al personal'])->only('index','indexActivos','indexBajas');
        $this->middleware('can:Agregar Personal')->only('store');
        $this->middleware('can:Editar información del personal')->only('edit','update');
        $this->middleware('can:Eliminar al personal')->only('destroy');

        $this->middleware('can:Asignar cuentas de usuarios al personal')->only('asignarCuenta');
        $this->middleware('can:Asignar Plazas al personal')->only('asignarPlaza');
    }

    public function index()
    {

        $Pagination=personal::paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];


        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Todos'
        ]); //Regresar a la vista personal
    }


    public function create(){
        return Inertia::render('Modulos/RH/Personal/AltaPersonal');
    }

    public function indexActivos(){

        $Pagination=personal::where('Estatus','A')->paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];


        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Activos'
        ]);
    }


    public function indexBajas(){

        $Pagination=personal::where('Estatus','B')->paginate(10);
        $personal=$Pagination->items();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();
        $usuariosDisponibles=app(UserController::class)->ObtenerUsuariosDisponibles();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = personal::all()->count();

        $ArregloFilas=[];


        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Modulos/RH/Personal/Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'usuariosDisponibles'=>$usuariosDisponibles,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
            'Paginator'=>$Pagination,
            'Filtro'=>'Bajas'
        ]);
    }

    public function store(Request $request)
    {

        $Personal=new personal();

        $Personal->RFC=$request->RFC;
        $Personal->Nombre=$request->Nombre;
        $Personal->ApellidoP=$request->ApellidoP;
        $Personal->ApellidoM=$request->ApellidoM;
        $Personal->CURP=$request->CURP;
        $Personal->Telefono=$request->Telefono;
        $Personal->Direccion=$request->Direccion;
        $Personal->CorreoPers=$request->CorreoPers;
        $Personal->FechaNacimiento=$request->FechaNacimiento;
        $Personal->numTarjeta=$request->numTarjeta;
        $Personal->Estatus='A';

        $Personal->save();

        return Redirect::route('Personal.index');

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

        $Personal=personal::find($id);

        if($Personal->Estatus=='A'){
            $Personal->Estatus='B';
        }
        else if($Personal->Estatus=='B'){
            $Personal->Estatus='A';
        }


        $Personal->save();

        return redirect::route('Personal.index');

    }

    public function buscarPersonal(Request $request){


        $Personal=$request->input('personal');
        $campo = $request->input('campo');
        $Filtro = $request->input('Filtro');


        if($Filtro=='Todos'){
            $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->get();
        }
        else if($Filtro=='Activos'){
            $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
            where('Estatus','=','A')->get();
        }
        else if($Filtro=='Bajas'){
            $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->
            where('Estatus','=','B')->get();
        }

        return $result;
    }



    public function asignarPlaza(Request $request){

        $Personal=personal::find($request->input('idPersonal'));
        $Personal->idPlaza=$request->input('idPlaza');
        $Personal->save();
        return redirect::route('Personal.index');

    }

    public function asignarCuenta(Request $request){

        $Personal=personal::find($request->input('idPersonal'));
        $Personal->idUsuario=$request->input('idCuenta');
        $Personal->save();
        return redirect::route('Personal.index');

    }

    public function ObtenerPersonal(){

        $Personal=personal::all();
        return $Personal;
    }
}
