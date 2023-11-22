<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware(['permission:Ver categorias de plaza|Agregar categorias de plaza|Editar informacion de categorias plaza|Eliminar categorias plaza'])->only('index');
    //     $this->middleware('can:Agregar categorias de plaza')->only('store');
    //     $this->middleware('can:Editar informacion de categorias plaza')->only('edit','update');
    //     $this->middleware('can:Eliminar categorias plaza')->only('destroy');
    // }

    public function __construct()
    {
        $this->middleware(['role:Recursos Humanos'])->only('index');
        $this->middleware(['role:Recursos Humanos'])->only('store');
        $this->middleware(['role:Recursos Humanos'])->only('edit','update');
        $this->middleware(['role:Recursos Humanos'])->only('destroy');
    }



    public function index(){

        $Pagination=categoria::paginate(10);//Este bombre aulas debe coincidir con el props en el scrip de vue
        $categorias=$Pagination->items();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/RH/Plazas/Categorias',[
            'categorias'=>$categorias,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);

    }

    public function store(Request $request){

        $categoria=new categoria();

        try{
            $categoria->Descripcion=$request->Descripcion;
            $categoria->Clave=$request->Clave;
            $categoria->Horas=$request->Horas;

            $categoria->save();
            Session::flash('mensaje', 'Se ha registrado la categoria correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('categorias.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al registrar la categoria');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('categorias.index');
        }
    }


    public function edit(String $id){
        $Categoria = categoria::find($id);
        return Inertia::render ('Modulos/RH/Plazas/formEditarCategorias',[
            'categoria'=>$Categoria,
        ]);
    }

    public function update(String $id,Request $request)
    {
        try{

            $Categoria=categoria::find($id);
            $Categoria->update($request->all());
            Session::flash('mensaje', 'Se han guardado los cambios correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('categorias.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al guardar los cambios');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('categorias.index');
        }

    }
    public function destroy(String $id){
        try{
            $Categoria = categoria::find($id);
            $Categoria->delete();
            Session::flash('mensaje', 'Se eliminado correctamente la categoria');
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('categorias.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al eliminar la categoria');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('categorias.index');
        }
    }

    public function ObtenerCategorias()
    {
        $categorias=categoria::all();
        return $categorias;
    }

    public function ObtenerCategoriaPorID(String $id)
    {
        $categoria=categoria::find($id);
        return $categoria;
    }

    public function buscar(Request $request){
        $Categoria=$request->input('categoria');

        $campo = $request->input('campo');

        $result=categoria::where($campo, 'LIKE', '%'.$Categoria.'%')->get();

        return $result;


    }

    public function cambiarPaginacion(Request $request){
        $ElementosPorPagina=$request->input('NumElementos');


        $Pagination=categoria::paginate($ElementosPorPagina);


        return response()->json(['Paginator'=>$Pagination]);
    }
}
