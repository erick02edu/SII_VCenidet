<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Mail\UsuarioRegistrado;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['permission:Agregar Usuarios|Editar Usuarios|Ver usuarios|Eliminar Usuarios|Asignar roles a los usuarios'])->only('index');
    //     $this->middleware('can:Agregar Usuarios')->only('store');
    //     $this->middleware('can:Editar Usuarios')->only('edit','update');
    //     $this->middleware('can:Eliminar Usuarios')->only('destroy');
    // }

    public function __construct()
    {
        $this->middleware(['role:Administrador'])->only('index');
        $this->middleware(['role:Administrador'])->only('store');
        $this->middleware(['role:Administrador'])->only('edit','update');
        $this->middleware(['role:Administrador'])->only('destroy');
    }

    //Funcion para mostrar todos los usuarios retorna a la vista de Usuarios
    public function index()
    {
        $Pagination=User::paginate(10);
        $Usuarios=$Pagination->items();

        $roles=Role::all();

        // Obtener datos flash de la sesión
        $mensaje = Session::get('mensaje');
        $TipoMensaje = Session::get('TipoMensaje');

        return Inertia::render('Modulos/Administrador/Usuarios/Usuarios',[
            'usuarios'=>$Usuarios,
            'roles'=>$roles,
            'Paginator'=>$Pagination,
            'mensaje' => $mensaje,
            'tipoMensaje' => $TipoMensaje,

        ]);
    }

    //Funcion para crear un usuario
    public function store(Request $request){


        $user=new User();
            try{
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password = Hash::make($request->input('password'));
            $user->Estatus='0';
            $user->save();

            $newUserId = $user->id;

            return redirect()->route('Roles.asignar', [
                'id' => $newUserId,
                'RolesSeleccionados'=>$request->input('RolesSeleccionados'),
            ]);
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al registrar el usuario');
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Users.index');
        }



        //Mail::to($user->email)->send(new UsuarioRegistrado($user));
    }


    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        $User = User::find($id);
        return Inertia::render ('Modulos/Administrador/Usuarios/formEditarUsuario',[
            'usuario'=>$User,
        ]);
    }

    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        try{
        $User=User::find($id);
        $User->update($request->all());

        Session::flash('mensaje', 'Se ha guardado los cambios');
        Session::flash('TipoMensaje', 'Exitoso');
        return redirect::route('Users.index');
        }
        catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al intentar actualizar los datos del usuario');
            Session::flash('TipoMensaje', 'Error');
            return redirect::route('Users.index');
        }
    }

    //Funcion para eliminar un usuario
    public function destroy(String $id)
    {

        try{
            $User = User::find($id);
            $User->delete();

            Session::flash('mensaje', 'Se ha eliminado correctamente al usuario '.$User->name);
            Session::flash('TipoMensaje', 'Exitoso');

            return Redirect::route('Users.index');
        }catch(Exception $e){
            Session::flash('mensaje', 'Ha ocurrido un error al eliminar al usuario '.$User->name);
            Session::flash('TipoMensaje', 'Error');
            return Redirect::route('Users.index');
        }
    }

    //Funcion para eliminar un usuario
    public function buscarUsuario(Request $request){
        $Usuario=$request->input('usuario');

        $campo = $request->input('campo');

        $result=User::where($campo, 'LIKE', '%'.$Usuario.'%')->get();

        return $result;
    }

    public function ObtenerUsuarios(){
        $Users=User::all();
        return $Users;
    }

    public function ObtenerUsuarioPorID(String $id){
        $user=User::find($id);
        return $user;
    }

    public function ObtenerUsuariosDisponibles()
    {
        $usuariosDisponibles=User::where('estatus','0')->get();
        return $usuariosDisponibles;
        
    }


    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosUsuario(String $idUsuario){
        $user = User::find($idUsuario); //obtener usuario autenticado
        $permisos = $user->permissions;

        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return $permisosNames;
    }


}
