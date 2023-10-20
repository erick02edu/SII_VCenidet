<?php

namespace App\Http\Controllers;

use App\Models\categoria;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    public function index(){


        $Pagination=categoria::paginate(10);//Este bombre aulas debe coincidir con el props en el scrip de vue
        $categorias=$Pagination->items();
        return Inertia::render('Modulos/RH/Plazas/Categorias',[
            'categorias'=>$categorias,
            'Paginator'=>$Pagination
        ]);

    }

    public function store(Request $request){

        $categoria=new categoria();

        $categoria->Descripcion=$request->Descripcion;
        $categoria->Clave=$request->Clave;
        $categoria->Horas=$request->Horas;

        $categoria->save();

        return redirect::route('categorias.index');
    }


    public function edit(String $id){
        $Categoria = categoria::find($id);
        return Inertia::render ('Modulos/RH/Plazas/formEditarCategorias',[
            'categoria'=>$Categoria,
        ]);
    }

    public function update(String $id,Request $request)
    {
        $Categoria=categoria::find($id);
        $Categoria->update($request->all());
        return redirect::route('categorias.index');
    }
    public function destroy(String $id){
        $Categoria = categoria::find($id);
        $Categoria->delete();
        return Redirect::route('categorias.index');
    }

    public function ObtenerCategorias()
    {
        $categorias=categoria::all();
        return $categorias;
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
