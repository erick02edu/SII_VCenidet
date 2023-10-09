<?php

namespace App\Http\Controllers;

use App\Models\personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonalController extends Controller
{

    public function index()
    {
        $personal=personal::all();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $plazasDisponibles=app(PlazaController::class)->ObtenerPlazasDisponibles();

        $usuarios=app(UserController::class)->ObtenerUsuarios();

        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        $numeroRegistros = $personal->count();

        $ArregloFilas=[];


        for( $i=0 ; $i<$numeroRegistros ;  $i++){
            array_push($ArregloFilas,false);
        }

        return Inertia::render('Personal',[
            'personal'=>$personal,
            'plazas'=>$plazas,
            'plazasDisponibles'=>$plazasDisponibles,
            'usuarios'=>$usuarios,
            'categorias'=>$categorias,
            'filas'=> $ArregloFilas,
        ]); //Regresar a la vista personal
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
        $Personal->Estatus='S';

        $Personal->save();

        return Redirect::route('Personal.index');

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $Plaza = personal::find($id);
        $Plaza->delete();
        return Redirect::route('Personal.index');
    }

    public function buscarPersonal(Request $request){
        $Personal=$request->input('personal');

        $campo = $request->input('campo');

        $result=personal::where($campo, 'LIKE', '%'.$Personal.'%')->get();

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

}
