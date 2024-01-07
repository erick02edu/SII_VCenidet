<?php

namespace App\Http\Controllers;

use App\Models\PermisosCarreras;
use Exception;
use Illuminate\Http\Request;

class PermisosCarrerasController extends Controller
{
    //Obtener los permisos de carrera de un usuario
    public function ObtenerPermisosCarrera(String $id){
        $Carreras=PermisosCarreras::where('idUsuario',$id)->get();
        $ListaCarreras=[];
        foreach($Carreras as $carrera){
             $carreraActual = app(CarreraController::class)->ObtenerCarreraPorID($carrera->idCarrera);
             array_push($ListaCarreras,$carreraActual);
        }
        return $ListaCarreras;
    }

    //Funcion para asignar permisos de carreras
    public function AsignarPermisos(Request $request){
        $CarrerasSeleccionadas=$request->input('CarrerasSelecionadas');
        $idUsuario=$request->input('idUsuario');

        foreach($CarrerasSeleccionadas as $Carrera){
            $PermisoCarrera=new PermisosCarreras();
            $PermisoCarrera->idCarrera=$Carrera;
            $PermisoCarrera->idUsuario=$idUsuario;

            $PermisoCarrera->save();
        }
        return response()->json([
            'mensaje'=>'Se ha asignado todos los permisos correctamente',
            'tipoMensaje'=>'Exitoso'
        ]);
    }
    //Funcion para eliminar un permiso de carrera
    public function EliminarPermiso(Request $request){
        try{
            $idUsuario=$request->input('idUsuario');
            $idCarrera=$request->input('idCarrera');

            $idEliminar=PermisosCarreras::
            where('idUsuario',$idUsuario)->
            where('idCarrera',$idCarrera)->
            value('id');

            $PermisoCarrera=PermisosCarreras::find($idEliminar);
            $PermisoCarrera->delete();

            return response()->json([
                'mensaje'=>'Se ha removido el permiso de la carrera correctamente',
                'tipoMensaje'=>'Exitoso'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'mensaje'=>'Ha ocurrido un erro al remover el permiso',
                'tipoMensaje'=>'Error'
            ]);
        }
    }
}


