<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Contracts\Permission;

class RoleController extends Controller
{

    public function __construct()
    {

        $this->middleware(['role:Administrador'])->only('index');
        $this->middleware(['role:Administrador'])->only('AsignarRol','EditRole');

        $this->middleware(['role:Administrador'])->only('store');
        $this->middleware(['role:Administrador'])->only('edit','update');
        $this->middleware(['role:Administrador'])->only('destroy');
    }

    public function index(){

        //$Roles=Role::all();
        $Pagination=Role::paginate(10);

        $Roles=$Pagination->items();
        $Permisos=app(PermissionController::class)->ObtenerPermisos();
        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/Administrador/RolesPermisos/Roles',[
            'roles'=>$Roles,
            'Permisos'=>$Permisos,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,
        ]);
    }


    public function verDashboard(){

        $roleName = 'Administrador'; // Reemplaza con el nombre del rol que deseas contar.
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $numAdmin = $role->users()->count();

        } else {
            $numAdmin=0;
        }


        $roleName = 'Usuario RH'; // Reemplaza con el nombre del rol que deseas contar.
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $numRH = $role->users()->count();

        } else {
            $numRH=0;
        }

        $roleName = 'Profesor'; // Reemplaza con el nombre del rol que deseas contar.
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $numProfes = $role->users()->count();

        } else {
            $numProfes=0;
        }

        $infoGrafica[0]=$numAdmin;
        $infoGrafica[1]=$numRH;
        $infoGrafica[2]=$numProfes;


        $User = Auth::user();

        $roles = $User->roles; // Esto obtendrá una colección de roles asignados al usuario

        $roleNames = $roles->pluck('name')->toArray();


        return Inertia::render('Dashboard',[
            'InfoGrafica'=>$infoGrafica,
            'rolesName'=>$roleNames
        ]);
    }

    public function store(Request $request){
        $Role=new Role();
        $Role->name=$request->name;
        $Role->guard_name='web';
        $Role->save();
        $newRoleId = $Role->id;



        return redirect()->route('Permisos.asignar', ['id' => $newRoleId, 'PermisosSeleccionados'=>$request->input('PermisosSeleccionados')]);
    }

    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        $Role = Role::find($id);
        return Inertia::render ('Modulos/Administrador/RolesPermisos/formEditarRol',[
            'rol'=>$Role,
        ]);
    }

    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        try{
            $Role=Role::find($id);
            $Role->update($request->all());
            Session::flash('mensaje', 'Cambio realizado exitosamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect::route('Roles.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'No se pudo realizar el cambio');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Roles.index');
        }

    }


    public function destroy(String $id)
    {
        try{
            $Role = Role::find($id);
            $Role->delete();
            Session::flash('mensaje', 'Se ha eliminado correctamente el rol');
            Session::flash('TipoMensaje', 'Exitoso');
            return Redirect::route('Roles.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'No se pudo eliminar el rol');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Roles.index');
        }


    }


    //Funcion para obtener rol del usuario authenticadp
    public function ObtenerRolUsuarioAutenticado()
    {
        $user=Auth::user(); //obtener usuario autenticado
        $roles = $user->roles; // Esto obtendrá una colección de roles asignados al usuario

        $roleNames = $roles->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaRoles'=>$roleNames]);
    }

    //Funcion para obtener rol de un usuario por medio de su id


    public function ObtenerRolUsuario(String $id)
    {
        $User = User::find($id); //obtener usuario autenticado
        $roles = $User->roles; // Esto obtendrá una colección de roles asignados al usuario

        $roleNames = $roles->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaRolesUsuario'=>$roleNames]);
    }


    //Funcion para redirigir al formulario de edicion del Role
    public function EditRole(String $id)
    {
        $User = User::find($id);

        $roles = $User->getRoleNames();

        $roleIds = $User->roles->pluck('id')->all();

        $ListaRoles=Role::all();

        return Inertia::render ('Modulos/Administrador/RolesPermisos/AsignarRol',[
            'usuario'=>$User,
            'RolesActuales'=>$roles,
            'ListaRolesTotal'=>$ListaRoles,
            'rolesMarcar'=>$roleIds
        ]);
    }

    public function AsignarRol(Request $request){

        $id=$request->input('id');
        $User = User::find($id);
        $User->roles()->sync($request->input('RolesSeleccionados'));

        //return redirect()->route('Users.editRole',$id)->with('Info','Se asigno los roles correctamente');
        Session::flash('mensaje', 'Usuario registrado correctamente');
        Session::flash('TipoMensaje', 'Exitoso');
        return back()->with([$id]);


    }


    public function buscarRol(Request $request){
        $rol=$request->input('Rol');

        $campo = $request->input('campo');

        $result=Role::where($campo, 'LIKE', '%'.$rol.'%')->get();

        return $result;
    }



}
