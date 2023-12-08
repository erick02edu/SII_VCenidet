<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Plaza;
use App\Models\categoria;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class PlazaController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['permission:Ver Plazas|Agregar Plazas|Editar Plazas|Eliminar Plazas'])->only('index');
    //     $this->middleware('can:Agregar Plazas')->only('store');
    //     $this->middleware('can:Editar Plazas')->only('edit','update');
    //     $this->middleware('can:Eliminar Plazas')->only('destroy');
    // }
    public function __construct()
    {
        $this->middleware(['role:Recursos Humanos'])->only('index','indexAsignado','indexSinAsignar');
        $this->middleware(['role:Recursos Humanos'])->only('store');
        $this->middleware(['role:Recursos Humanos'])->only('edit','update');
        $this->middleware(['role:Recursos Humanos'])->only('destroy');
    }


    public function index()
    {
        $Pagination=Plaza::paginate(5);
        $Plazas=$Pagination->items();
        $Categorias=app(CategoriaController::class)->ObtenerCategorias();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');


        return Inertia::render('Modulos/RH/Plazas/Plazas',[
            'plazas'=>$Plazas,
            'categorias'=>$Categorias,
            'Paginator'=>$Pagination,
            'Filtro'=>'Todos',
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }

    public function indexAsignadas()
    {
        $Pagination=Plaza::where('estatus','1')->paginate(5);

        $Plazas=$Pagination->items();
        $Categorias=app(CategoriaController::class)->ObtenerCategorias();

        return Inertia::render('Modulos/RH/Plazas/Plazas',[
            'plazas'=>$Plazas,
            'categorias'=>$Categorias,
            'Paginator'=>$Pagination,
            'Filtro'=>'Asignadas',
        ]);
    }

    public function indexNoAsignadas()
    {
        $Pagination=Plaza::where('estatus','0')->paginate(5);
        $Plazas=$Pagination->items();
        $Categorias=app(CategoriaController::class)->ObtenerCategorias();

        return Inertia::render('Modulos/RH/Plazas/Plazas',[
            'plazas'=>$Plazas,
            'categorias'=>$Categorias,
            'Paginator'=>$Pagination,
            'Filtro'=>'NoAsignadas',
        ]);
    }

    public function store(Request $request)
    {

        $Plaza=new Plaza();

        if($request->idCategoria==0){
            $Plazas=Plaza::all();//Este bombre aulas debe coincidir con el props en el scrip de vue
            return Inertia::render ('Plazas',['plazas'=>$Plazas,'mensajeCategorias'=>'Por favor ingresa una categoria']);
        }

        try{
            $Estatus = False; // asigna el valor TRUE a $foo
            $Plaza->idCategoria=$request->idCategoria;
            $Plaza->unidad=$request->unidad;
            $Plaza->subunidad=$request->subunidad;
            $Plaza->diagonal=$request->diagonal;
            $Plaza->horas=$request->horas;
            $Plaza->TipoMovimiento=$request->TipoMovimiento;
            $Plaza->estatus=$Estatus;
            $Plaza->save();

            Session::flash('mensaje', 'Se ha registrado la plaza correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Plazas.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al registrar la plaza');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Plazas.index');
        }
    }

    public function ObtenerPlazas()
    {
        $plazas=Plaza::all();
        return $plazas;
    }

    public function ObtenerPlazaPorID(String $id)
    {
        $plaza=Plaza::find($id);
        return $plaza;
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
        try{
            $Plaza=Plaza::find($id);

            $Plaza->idCategoria=$request->input('idCategoria');
            $Plaza->save();
            //return response()->json(['idCategoria:',$request->input('idCategoria')]);
            $Plaza->update($request->all());
            Session::flash('mensaje', 'Se guardado los cambios correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Plazas.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al guardar los cambios');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Plazas.index');
        }
    }

    public function getData(String $id){
        $Plaza = Plaza::find($id);
        return response()->json($Plaza);
    }

    //Funcion para eliminar una plaza
    public function destroy(String $id)
    {
        try{
            $Plaza = Plaza::find($id);
            $Plaza->delete();
            Session::flash('mensaje', 'Se eliminado la plaza correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('Plazas.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ocurrio un error al eliminar la plaza');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Plazas.index');
        }
    }

    public function buscarPlaza(Request $request){
        $Plaza=$request->input('plaza');
        $campo = $request->input('campo');
        $Filtro=$request->input('Filtro');


        if($Filtro=='Todos'){

            if($campo=='categoria'){
                $request=new Request();
                $parametros=['categoria'=>$Plaza,'campo'=>'Descripcion'];
                //Unir $parametros a request
                $request->merge($parametros);

                $users=app(CategoriaController::class)->buscar($request);

                $ListaIDS=$users->pluck('id');

                $result=Plaza::whereIn('idCategoria',$ListaIDS)->get();

            }
            else{
            $result=Plaza::where($campo, 'LIKE', '%'.$Plaza.'%')->get();
            }
        }
        else if($Filtro=='Asignadas'){

            if($campo=='categoria'){
                $request=new Request();
                $parametros=['categoria'=>$Plaza,'campo'=>'Descripcion'];
                //Unir $parametros a request
                $request->merge($parametros);

                $users=app(CategoriaController::class)->buscar($request);

                $ListaIDS=$users->pluck('id');

                $result=Plaza::whereIn('idCategoria',$ListaIDS)->
                where('estatus','=','1')->get();
            }
            else{
                $result=Plaza::where($campo, 'LIKE', '%'.$Plaza.'%')->
                where('estatus','=','1')->get();
            }
        }
        else if($Filtro=='NoAsignadas'){

            if($campo=='categoria'){
                $request=new Request();
                $parametros=['categoria'=>$Plaza,'campo'=>'Descripcion'];
                //Unir $parametros a request
                $request->merge($parametros);

                $users=app(CategoriaController::class)->buscar($request);

                $ListaIDS=$users->pluck('id');

                $result=Plaza::whereIn('idCategoria',$ListaIDS)->
                where('estatus','=','0')->get();
            }
            else{
                $result=Plaza::where($campo, 'LIKE', '%'.$Plaza.'%')->
                where('estatus','=','0')->get();
            }
        }
        return $result;
    }
}
