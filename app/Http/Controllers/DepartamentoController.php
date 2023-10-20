<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver departamentos|Agregar Departamentos|Editar información de los departamentos|Eliminar departamentos'])->only('index');
        $this->middleware('can:Agregar Departamentos')->only('store');
        $this->middleware('can:Editar información de los departamentos')->only('edit','update');
        $this->middleware('can:Eliminar departamentos')->only('destroy');
    }

    public function index()
    {
        $departamentos=Departamentos::all();

        $personal=app(PersonalController::class)->ObtenerPersonal();
        return Inertia::render('Departamentos',['departamentos'=>$departamentos,'personal'=>$personal]);
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
        $personal=app(PersonalController::class)->ObtenerPersonal();

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


            //Unir $parametros a request
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
