<?php

namespace App\Http\Controllers;

use App\Models\categoria;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){

        $categorias=categoria::all();
        return response()->json(['categorias'=>$categorias]);
    }


    public function ObtenerCategorias()
    {
        $categorias=categoria::all();
        return $categorias;
    }
}
