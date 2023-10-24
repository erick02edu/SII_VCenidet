<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Plaza;
use App\Models\categoria;
use Illuminate\Support\Facades\Redirect;

class PlazaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver Plazas|Agregar Plazas|Editar Plazas|Eliminar Plazas'])->only('index');
        $this->middleware('can:Agregar Plazas')->only('store');
        $this->middleware('can:Editar Plazas')->only('edit','update');
        $this->middleware('can:Eliminar Plazas')->only('destroy');
    }



    public function index()
    {

        $Pagination=Plaza::paginate(10);

        $Plazas=$Pagination->items();

        $Categorias=app(CategoriaController::class)->ObtenerCategorias();

        return Inertia::render('Modulos/RH/Plazas/Plazas',[
            'plazas'=>$Plazas,
            'categorias'=>$Categorias,
            'Paginator'=>$Pagination
        ]);
    }

    public function store(Request $request)
    {

        $Plaza=new Plaza();

        if($request->idCategoria==0){
            $Plazas=Plaza::all();//Este bombre aulas debe coincidir con el props en el scrip de vue
            return Inertia::render ('Plazas',['plazas'=>$Plazas,'mensajeCategorias'=>'Por favor ingresa una categoria']);
        }

        $Estatus = False; // asigna el valor TRUE a $foo
        $Plaza->idCategoria=$request->idCategoria;
        $Plaza->unidad=$request->unidad;
        $Plaza->subunidad=$request->subunidad;
        $Plaza->diagonal=$request->diagonal;
        $Plaza->horas=$request->horas;
        $Plaza->estatus=$Estatus;

        $Plaza->save();

        return redirect::route('Plazas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plaza $plaza)
    {
        //
    }

    public function ObtenerPlazas()
    {
        $plazas=Plaza::all();
        return $plazas;
    }

    public function ObtenerPlazasDisponibles()
    {
        $plazasDisponibles=Plaza::where('estatus','0')->get();
        return $plazasDisponibles;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {

        $Plaza = Plaza::find($id);
        $categoriaEditar=categoria::find($Plaza->idCategoria);
        $Listacategorias=categoria::all();



        return Inertia::render ('Modulos/RH/Plazas/formEditarPlaza',[
            'plaza'=>$Plaza,
            'categoriaEditar'=>$categoriaEditar,
            'ListaCategorias'=>$Listacategorias,
        ]);
    }

    public function update(String $id,Request $request)
    {
        $Plaza=Plaza::find($id);

        $Plaza->idCategoria=$request->input('idCategoria');
        $Plaza->save();
        //return response()->json(['idCategoria:',$request->input('idCategoria')]);
        $Plaza->update($request->all());
        return redirect::route('Plazas.index');
    }

    public function getData(String $id){
        $Plaza = Plaza::find($id);
        return response()->json($Plaza);
    }

    //Funcion para eliminar una plaza
    public function destroy(String $id)
    {
        $Plaza = Plaza::find($id);
        $Plaza->delete();
        return Redirect::route('Plazas.index');
    }

    public function buscarPlaza(Request $request){
        $Plaza=$request->input('plaza');

        $campo = $request->input('campo');

        $result=Plaza::where($campo, 'LIKE', '%'.$Plaza.'%')->get();

        return $result;
    }
}
