<?php

namespace App\Http\Controllers;

use App\Mail\NuevoAviso;
use App\Models\Avisos_Usuarios;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AvisosUsuarioController extends Controller
{
    public function store(Request $request){

        $Aviso=$request->input('Aviso');
        $ListaUsuarios=$request->input('ListaUsuario');



        foreach($ListaUsuarios as $Usuario){
            // try{


                $AvisoUsuario=new Avisos_Usuarios();
                $AvisoUsuario->idAviso=$Aviso->id;
                $AvisoUsuario->idUsuario=$Usuario['id'];
                $AvisoUsuario->save();
                //$user=app(UserController::class)->ObtenerUsuarioPOrID($Usuario['id']);



                Mail::to($Usuario['email'])->send(new NuevoAviso($Aviso->Titulo));

            // }
            // catch(Exception $e){

            // }
        }

        Session::flash('mensaje', 'Se ha publicado el aviso correctamente');
        Session::flash('TipoMensaje', 'Exitoso');

        return Redirect::route('Avisos.index');






    }
}
