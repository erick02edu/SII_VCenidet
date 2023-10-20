<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class MateriasController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver materias|Agregar Materias|Editar Materias|Eliminar Materias'])->only('index');
        $this->middleware('can:Agregar Materias')->only('store');
        $this->middleware('can:Editar Materias')->only('edit','update');
        $this->middleware('can:Eliminar Materias')->only('destroy');
    }


    public function index(){
        $Materias=Materias::all();
        return inertia::render('Modulos/RH/Materias/Materias',[
            'materias'=>$Materias
        ]);
    }

    public function store(Request $request){
        $Materia=new Materias();

        $Materia->Nombre=$request->Nombre;
        $Materia->Descripcion=$request->Descripcion;
        $Materia->Codigo=$request->Codigo;

        $Materia->save();

        //return response()->json($Aula);
        return redirect::route('Materias.index');
    }

    public function edit(String $id){
        $Materia = Materias::find($id);
        return Inertia::render ('Modulos/RH/Materias/formEditarMateria',[
            'materia'=>$Materia,
        ]);
    }

    public function update(Request $request, String $id){
        $Materia=Materias::find($id);

        $Materia->update($request->all());

        return redirect::route('Materias.index');
    }

    public function destroy(String $id){
        $Materia = Materias::find($id);
        $Materia->delete();
        return Redirect::route('Materias.index');
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
