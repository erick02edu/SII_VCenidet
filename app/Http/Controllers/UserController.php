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

use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //Funcion para mostrar todos los usuarios retorna a la vista de Usuarios
    public function index()
    {
        $Usuarios=User::all();//Este bombre aulas debe coincidir con el props en el scrip de vue
        return Inertia::render('Usuarios',['usuarios'=>$Usuarios]);
    }

    //Funcion para crear un usuario
    public function store(Request $request){
        $User=new User();

        $User->name=$request->name;
        $User->email=$request->email;
        $User->password = Hash::make($request->input('password'));

        $User->save();

        $newUserId = $User->id;

        return redirect()->route('Roles.asignar', ['id' => $newUserId, 'RolesSeleccionados'=>$request->input('RolesSeleccionados')]);

    }


    //Funcion para redirigir al formulario de edicion
    public function edit(String $id)
    {
        $User = User::find($id);
        return Inertia::render ('formEditarUsuario',[
            'usuario'=>$User,
        ]);
    }

    //Funcion para actualizar un usuario
    public function update(String $id,Request $request)
    {
        $User=User::find($id);
        $User->update($request->all());
        return redirect::route('Users.index');
    }

    public function destroy(String $id)
    {
        $User = User::find($id);
        $User->delete();
        return Redirect::route('Users.index');
    }


    public function buscarUsuario(Request $request){
        $Usuario=$request->input('usuario');

        $campo = $request->input('campo');

        $result=User::where($campo, 'LIKE', '%'.$Usuario.'%')->get();

        return $result;
    }

}
