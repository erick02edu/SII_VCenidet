<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Contracts\Permission;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session;



class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only(['editPermisos','asignar']);
    }

    public function index()
    {

    }

    public function GetPermisos(){
        $Permisos=Permission::all();
        return response()->json(['ListaPermisos'=>$Permisos]);
    }

    public function ObtenerPermisos(){
        $Permisos=Permission::all();
        return $Permisos;
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

        // $permissions = $Role->permissions;
        // $permissionsArray = $permissions->pluck('name')->toArray();
        // $permissionsID = $permissions->pluck('id')->toArray();

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

    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosRol(String $id){
        $Role = Role::find($id); //obtener usuario autenticado

        $permisos = $Role->permissions;// Esto obtendrá una colección de permisos asignados a un rol
        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaPermisosRol'=>$permisosNames]);
    }

    public function ObtenerPermisosUsuario(String $idUsuario){
        $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario);
        $permisosUsuario = $user->permissions;

        return $permisosUsuario;

    }

    public function AsignarPermisosUsuario(Request $request){

        $idUsuario=$request->input('idUsuario');
        $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario);
        $PermisosSeleccionados=$request->input('PermisosSeleccionados');

        foreach($PermisosSeleccionados as $Permiso){
            $user->givePermissionTo($Permiso); //AsignarPermisos a un determinado Usuario
        }

        return response()->json([
            'mensaje'=>'Se ha asignado todos los permisos del sistema correctamente',
            'tipoMensaje'=>'Exitoso'
        ]);

        return back();
    }

    public function RemoverPermiso(Request $request){

        try{
            $idUsuario=$request->input('idUsuario');
            $idPermiso=$request->input('idPermiso');

            $user=app(UserController::class)->ObtenerUsuarioPorID($idUsuario);
            $permiso = Permission::findById($idPermiso);

            $user->revokePermissionTo($permiso);


            return response()->json([
                'mensaje'=>'Se ha removido el permiso correctamente',
                'tipoMensaje'=>'Exitoso'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'mensaje'=>'Ocurrio un erroral remover el permiso',
                'tipoMensaje'=>'Error'
            ]);
        }
    }

    public function Buscar(Request $request){
        $Permiso=$request->input('Permiso');

        $result=Permission::where('name', 'LIKE', '%'.$Permiso.'%')->get();

        return $result;

    }

}
