<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\PermisosCarreras;
use Illuminate\Http\Request;


class CarreraController extends Controller
{
    public function ObtenerCarreras(){
        $Carreras=Carrera::all();
        return $Carreras;
    }

    public function ObtenerCarreraPorID(String $id){
        $Carrera=Carrera::find ($id);
        return $Carrera;
    }

    public function Buscar(Request $request){
        $Carrera=$request->input('Carrera');
        $idUsuario=$request->input('idUsuario');


        $result=Carrera::
        whereRaw("CONCAT(Nivel,' en ',Nombre) LIKE ?",['%'.$Carrera.'%'])->
        get();


        return $result;

    }
}
