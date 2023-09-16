<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Spatie\Permission\Contracts\Permission;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function GetPermisos(){

        $Permisos=Permission::all();
        return response()->json(['ListaPermisos'=>$Permisos]);
    }

    //Asignar permisos a un determinado Rol por su Id
    public function asignarPermisos(Request $request){
        $id=$request->input('id');
        $Role = Role::find($id);

        $Role->syncPermissions([$request->input('PermisosSeleccionados')]);

        return back()->with([$id]);
    }

    //Funcion para ir al formulario para editar los permisos de un rol
    public function EditPermisos(String $id){
        $Role = Role::find($id);
        return Inertia::render ('AsignarPermisos',[
            'rol'=>$Role,
        ]);
    }

    //Funcion para obtener los permisos de un determinado rol
    public function ObtenerPermisosRol(String $id){
        $Role = Role::find($id); //obtener usuario autenticado

        $permisos = $Role->permissions;// Esto obtendrá una colección de permisos asignados a un rol
        $permisosNames = $permisos->pluck('name')->toArray(); //Obtener solo un array con el nombre de los roles
        return response()->json(['ListaPermisosRol'=>$permisosNames]);
    }


    public function can(Request $request){

        //Recuperamos los datos
        $id = $request->input('userID');
        $permiso = $request->input('Permiso');

        //Obtenemos el usuario por su ID
        $User = User::find($id);

        //Verificamos si el usuario tiene el permiso enviado
        //hasPermissionTo retorna true o false de acuerdo a si tiene la funcion
        $desicion=$User->hasPermissionTo($permiso,'web');

        //Obtenemos lista de roles
        return response()->json(['decision'=>$desicion]);

    }
}
