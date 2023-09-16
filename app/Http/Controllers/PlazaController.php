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
        $this->middleware('can:Agregar Plazas')->only('store');
        $this->middleware('can:Ver Plazas')->only('index');
        $this->middleware('can:Editar Plazas')->only('edit','update');
        $this->middleware('can:Eliminar Plazas')->only('destroy');
    }



    public function index()
    {
        $Plazas=Plaza::all();//Este bombre aulas debe coincidir con el props en el scrip de vue
        return Inertia::render('Plazas',['plazas'=>$Plazas]);
    }

    public function create()
    {
        //
        return Inertia::render('FormCrear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $Plaza=new Plaza();

        if($request->idCategoria==0){
            $Plazas=Plaza::all();//Este bombre aulas debe coincidir con el props en el scrip de vue
            return Inertia::render ('Plazas',['plazas'=>$Plazas,'mensajeCategorias'=>'Por favor ingresa una categoria']);
        }

        $Plaza->idCategoria=$request->idCategoria;
        $Plaza->unidad=$request->unidad;
        $Plaza->subunidad=$request->subunidad;
        $Plaza->diagonal=$request->diagonal;
        $Plaza->horas=$request->horas;
        $Plaza->estatus=$request->estatus;

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {

        $Plaza = Plaza::find($id);
        $categoriaEditar=categoria::find($Plaza->idCategoria);
        $Listacategorias=categoria::all();



        return Inertia::render ('formEditarPlaza',[
            'plaza'=>$Plaza,
            'categoriaEditar'=>$categoriaEditar,
            'ListaCategorias'=>$Listacategorias,
        ]);
    }

    public function update(String $id,Request $request)
    {
        $Plaza=Plaza::find($id);

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
