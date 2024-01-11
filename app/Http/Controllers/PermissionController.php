<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only(['editPermisos','asignar']);
    }
    //Asignar permisos a un determinado Rol por su Id
    public function asignarPermisos(Request $request){
        $id=$request->input('id');
        $Role = Role::find($id);

        $Role->syncPermissions([$request->input('PermisosSeleccionados')]);

        Session::flash('mensaje', 'Se ha creado correctamente el nuevo rol');
        Session::flash('TipoMensaje', 'Exitoso');

        return back()->with([$id]);
    }
    //Funcion para ir al formulario para editar los permisos de un rol
    public function EditPermisos(String $id){
        $Role = Role::find($id);
        if($Role){
        $UsuarioRoles=$Role->users;
        $ListaCarreras=app(CarreraController::class)->ObtenerCarreras();
        $ListaPermisos=Permission::all();
         // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');
        return Inertia::render ('Modulos/Administrador/RolesPermisos/AsignarPermisos',[
            'rol'=>$Role,
            'usuarios'=>$UsuarioRoles,
            'carreras'=>$ListaCarreras,
            'permisos'=>$ListaPermisos,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,

        ]);
        }
        else{
            return back();
        }
    }
    //Funcion para obtener lista de permisos
    public function ObtenerPermisos(){
        $Permisos=Permission::all();
        return $Permisos;
    }
    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosRol(String $id){
        $Role = Role::find($id); //obtener usuario autenticado
        $permisos = $Role->permissions;// Esto obtendrá una colección de permisos asignados a un rol
        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaPermisosRol'=>$permisosNames]);
    }
    //Funcion para obtener los permisos de un usuario
    public function ObtenerPermisosUsuario(String $idUsuario){
        $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario);
        $permisosUsuario = $user->permissions;
        return $permisosUsuario;
    }
    //Funcion para asignar una lista de permisos a un usuario
    public function AsignarPermisosUsuario(Request $request){
        $idUsuario=$request->input('idUsuario'); //Obtener id usuario
        $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario); //Obtener Usuario
        $PermisosSeleccionados=$request->input('PermisosSeleccionados'); //Obtener lista de permisos

        foreach($PermisosSeleccionados as $Permiso){
            $user->givePermissionTo($Permiso); //AsignarPermisos a un determinado Usuario
        }
        return response()->json([
            'mensaje'=>'Se ha asignado todos los permisos del sistema correctamente',
            'tipoMensaje'=>'Exitoso'
        ]);
        return back();
    }
    //Quitar un permiso a un usuario
    public function RemoverPermiso(Request $request){
        try{
            $idUsuario=$request->input('idUsuario');
            $idPermiso=$request->input('idPermiso');

            $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario);
            $permiso = Permission::findById($idPermiso,'web');

            $user->revokePermissionTo($permiso); //Remover permiso

            return response()->json([
                'mensaje'=>'Se ha removido el permiso correctamente',
                'tipoMensaje'=>'Exitoso'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'mensaje'=>'Ocurrio un error al remover el permiso',
                'tipoMensaje'=>'Error'
            ]);
        }
    }
    //Funcion para buscar un permiso
    public function Buscar(Request $request){
        $Permiso=$request->input('Permiso'); //Obtener cadena enviada
        $result=Permission::where('name', 'LIKE', '%'.$Permiso.'%')->get(); //Hacer busqueda
        return $result;//Devolver resultados
    }
}
