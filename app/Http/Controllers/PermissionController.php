<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Contracts\Permission;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
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

        $permissions = $Role->permissions;
        $permissionsArray = $permissions->pluck('name')->toArray();
        $permissionsID = $permissions->pluck('id')->toArray();

        $ListaPermisos=Permission::all();


        return Inertia::render ('Modulos/Administrador/RolesPermisos/AsignarPermisos',[
            'rol'=>$Role,
            'permisosAsignados'=>$permissionsArray,
            'permisosIDAsignados'=>$permissionsID,
            'ListaPermisosTotal'=>$ListaPermisos
        ]);
    }

    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosRol(String $id){
        $Role = Role::find($id); //obtener usuario autenticado

        $permisos = $Role->permissions;// Esto obtendrá una colección de permisos asignados a un rol
        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaPermisosRol'=>$permisosNames]);
    }


}
