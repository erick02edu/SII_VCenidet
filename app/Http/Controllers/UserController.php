<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //
        $Usuarios=User::all();             //Este bombre aulas debe coincidir con el props en el scrip de vue
        return Inertia::render('Mostrar',['usuarios'=>$Usuarios]);
    }

    public function ObtenerUsuarioAutenticado()
    {
        $nombreUsuario = Auth::user()->name;
        return response()->json(['NombreUsuario'=>$nombreUsuario]);
    }


}
