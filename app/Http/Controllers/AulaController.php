<?php
//Importaciones
namespace App\Http\Controllers;
use App\Models\Aula;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class AulaController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:Ver aulas|Agregar aulas|Editar aulas|Eliminar aulas'])->only('index');
        $this->middleware('can:Agregar aulas')->only('store');
        $this->middleware('can:Editar aulas')->only('edit','update');
        $this->middleware('can:Eliminar aulas')->only('destroy');
    }

    //Funcion para obtener los datos de todas las aulas
    public function index()
    {
        $Aulas=Aula::all();
        return Inertia::render('Aulas',['aulas'=>$Aulas]); //Regresar a la vista mostrar
    }

    //Funcion para registrar una nueva Aula
    public function store(Request $request)
    {

        $Aula=new Aula();
        $Aula->NombreAula=$request->NombreAula;
        $Aula->Capacidad=$request->Capacidad;
        $Aula->Ubicacion=$request->Ubicacion;

        $Aula->save();
        return redirect::route('Aulas.index');
    }

    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        $Aula = Aula::find($id);
        return Inertia::render ('formEditarAulas',[
            'aula'=>$Aula,
        ]);
    }

    //Funcion para actualizar un aula
    public function update(String $id,Request $request)
    {
        $Aula=Aula::find($id);
        $Aula->update($request->all());
        return redirect::route('Aulas.index');
    }

    //Funcion para obtener la informacion de un aula en especifico
    public function getData(String $id){
        $Aula = Aula::find($id);
        return response()->json($Aula);
    }

    //Funcion para eliminar un aula
    public function destroy(String $id)
    {
        $Aula = Aula::find($id);
        $Aula->delete();
        return Redirect::route('Aulas.index');
    }

    public function ObtenerAulas(){
        $Aulas=Aula::all();
        return $Aulas;
    }
}
