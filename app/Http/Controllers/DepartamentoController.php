<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos=Departamentos::all();

        $users=app(UserController::class)->ObtenerUsuarios();
        return Inertia::render('Departamentos',['departamentos'=>$departamentos,'personal'=>$users]);
    }

    //Crear nuevo departamento
    public function store(Request $request)
    {
        $Departamento=new Departamentos();

        $Departamento->Nombre=$request->Nombre;
        $Departamento->Descripcion=$request->Descripcion;
        $Departamento->idEncargado = $request->idEncargado;

        $Departamento->save();

        return redirect::route('Departamentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Departamento = Departamentos::find($id);
        $personal=app(UserController::class)->ObtenerUsuarios();

        return Inertia::render ('formEditarDepartamento',[
            'departamento'=>$Departamento,
            'personal'=>$personal,
        ]);
    }


    public function update(Request $request, string $id)
    {
        $Departamento=Departamentos::find($id);

        $Departamento->update($request->all());

        return redirect::route('Departamentos.index');
    }


    public function destroy(string $id)
    {
        $Departamento = Departamentos::find($id);
        $Departamento->delete();
        return Redirect::route('Departamentos.index');
    }


    public function buscarDepartamento(Request $request){
        $Departamento=$request->input('departamento');

        $campo = $request->input('campo');

        if($campo=='idEncargado'){

            $request=new Request();
            $parametros=['usuario'=>$Departamento,'campo'=>'name'];

            $request->merge($parametros);

            $users=app(UserController::class)->buscarUsuario($request);

            $ListaIDS=$users->pluck('id');


            $result=Departamentos::whereIn('idEncargado',$ListaIDS)->get();



        }
        else{
            $result=Departamentos::where($campo, 'LIKE', '%'.$Departamento.'%')->get();
        }
        //return $result;
        return $result;

    }
}
