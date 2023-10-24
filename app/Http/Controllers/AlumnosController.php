<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlumnosController extends Controller
{
    public function index(){

        $Pagination=Alumnos::paginate(10);
        $Alumnos=$Pagination->items();

        return Inertia::render('Modulos/Serv_Escolares/Alumnos',[
            'alumnos'=>$Alumnos,
            'Paginator'=>$Pagination
        ]);
    }
}
