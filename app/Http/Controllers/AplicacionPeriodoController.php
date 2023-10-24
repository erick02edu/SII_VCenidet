<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplicacionPeriodos;
use Inertia\Inertia;
use App\Models\Periodos;
use Illuminate\Support\Facades\Redirect;


class AplicacionPeriodoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Ver periodos de aplicacion|Agregar Periodos de aplicacion|Editar Información de los periodos de aplicacion|Eliminar Periodos de Aplicacion|Actualizar fechas en los periodos de aplicacion'])->only('index');
        $this->middleware('can:Agregar Periodos de aplicacion')->only('store');
        $this->middleware('can:Actualizar fechas en los periodos de aplicacion')->only('actualizar');
        $this->middleware('can:Eliminar Periodos de Aplicacion')->only('destroy');
    }

    public function index(){

        //$AplicacionPeriodo=AplicacionPeriodos::all();

        $Pagination=AplicacionPeriodos::paginate(10);

        $AplicacionPeriodo=$Pagination->items();

        $periodos=Periodos::all();

        $ListaIdPeriodos=AplicacionPeriodos::all()->pluck('idPeriodo')->toArray();
        $ListaIdAplicaciones= AplicacionPeriodos::all()->pluck('id')->toArray();

        return Inertia::render('PeriodoAplicacion',[
            'aplicaciones'=>$AplicacionPeriodo,
            'periodos'=>$periodos,
            'ListaIDAplicaciones'=>$ListaIdAplicaciones,
            'ListaIDPeriodos'=>$ListaIdPeriodos,
            'Paginator'=>$Pagination
        ]);
    }


    public function store(Request $request){
        $Aplicacion=new AplicacionPeriodos();
        $Aplicacion->descripcion=$request->descripcion;
        $Aplicacion->idPeriodo=$request->idPeriodo;
        $Aplicacion->save();
        return Redirect::route('Aplicaciones.index');
    }

    //Funcion para eliminar una aplicacion
    public function destroy(String $id)
    {
        $Aplicacion = AplicacionPeriodos::find($id);
        $Aplicacion->delete();
        $mensaje='Se ha eliminado correctamento esta aplicacion';
        return Redirect::route('Aplicaciones.index',['msEliminar'=>$mensaje]);
    }

    public function actualizar(Request $request){
        $cont=0;
        $ListaIDAplicaciones=$request->input('ListaIDAplicaciones');
        $ListaIdPeriodos=$request->input('ListaIDPeriodos');

        foreach($ListaIDAplicaciones as $idAplicacion){
            $Aplicacion=AplicacionPeriodos::find($idAplicacion);
            $idNuevo=$ListaIdPeriodos[$cont];
            $Aplicacion->idPeriodo=$idNuevo;
            $Aplicacion->save();
            $cont=$cont+1;
        };

        return Redirect::route('Aplicaciones.index');
        //return response()->json(['respuesta'=>'Aplicaciones actualizadas']);
    }

    public function buscarAplicacion(Request $request){

        $Aplicacion=$request->input('aplicacion');
        $campo = $request->input('campo');
        if($campo=='idPeriodo'){
            $request=new Request();
            $parametros=['periodoBuscar'=>$Aplicacion];
            $request->merge($parametros);
            $periodos=app(PeriodoController::class)->buscarPeriodoCompleto($request);
            $ListaIDS=$periodos->pluck('id');
            $result=AplicacionPeriodos::whereIn('idPeriodo',$ListaIDS)->get();
        }else{
            $result=AplicacionPeriodos::where($campo, 'LIKE', '%'.$Aplicacion.'%')->get();
        }
        return $result;
    }
}
