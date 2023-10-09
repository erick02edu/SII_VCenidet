<?php

namespace App\Http\Controllers;

use App\Models\Profesores;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class ProfesoresController extends Controller
{
    public function index(){
        $profesores=Profesores::all();
        return inertia::render('Profesores',['profesores'=>$profesores]);
    }

    public function store(Request $request){
        $Profesores=new Profesores();

        $Profesores->Nombre=$request->Nombre;
        $Profesores->ApellidoP=$request->ApellidoP;
        $Profesores->ApellidoM=$request->ApellidoM;
        $Profesores->FechaNac=$request->FechaNac;
        $Profesores->genero=$request->genero;
        $Profesores->NumeroTel=$request->NumeroTel;
        $Profesores->Especialidad=$request->Especialidad;

        $Profesores->save();

        return redirect::route('Profesores.index');
    }
    public function edit(String $id){
        $Profesor = Profesores::find($id);
        return Inertia::render ('formEditarProfesor',[
            'profesor'=>$Profesor,
        ]);
    }

    public function update(String $id,Request $request){
        $Profesor=Profesores::find($id);
        $Profesor->update($request->all());
        return redirect::route('Profesores.index');
    }

    public function destroy(String $id){
        $Profesor = Profesores::find($id);
        $Profesor->delete();
        return Redirect::route('Profesores.index');
    }

    public function ObtenerProfesores(){
        $Profesores=Profesores::all();
        return $Profesores;
    }
}
