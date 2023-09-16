<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplicacionPeriodos;
use Inertia\Inertia;
use App\Models\Periodos;
use Illuminate\Support\Facades\Redirect;


class AplicacionPeriodoController extends Controller
{
    public function index(){

        $AplicacionPeriodo=AplicacionPeriodos::all();
        $periodos=Periodos::all();

        return Inertia::render('PeriodoAplicacion',['aplicaciones'=>$AplicacionPeriodo,'periodos'=>$periodos]); //Regresar a la vista mostrar
    }


    //Funcion para eliminar una aplicacion
    public function destroy(String $id)
    {
        $Aplicacion = AplicacionPeriodos::find($id);
        $Aplicacion->delete();
        return Redirect::route('Aplicaciones.index');
        // $data = ['mensaje' => 'Aplicación eliminada'];
        // return response()->json($data);


    }

    public function actualizar(Request $request){

        $cont=0;

        $ListaIDAplicaciones=$request->input('ListaIDAplicaciones');
        $ListaIdPeriodos=$request->input('ListaIDPeriodos');

        foreach($ListaIDAplicaciones as $idAplicacion){

            $Aplicacion=AplicacionPeriodos::find($idAplicacion);

            //$Aplicacion->idPeriodo=$ListaIdPeriodos[$cont];

            $idNuevo=$ListaIdPeriodos[$cont];

            $Aplicacion->idPeriodo=$idNuevo;

            $Aplicacion->save();



            $cont=$cont+1;

        };


        return response()->json(['respuesta'=>'Aplicaciones actualizadas']);
    }
}
