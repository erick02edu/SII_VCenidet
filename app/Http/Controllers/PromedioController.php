<?php

namespace App\Http\Controllers;
use App\Models\historial_Alumno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Periodos;

class PromedioController extends Controller
{
    public function index(){



        $calificaciones=historial_Alumno::all();
        $periodos=Periodos::all();
        //return redirect()->route('Periodo.index', ['calificaciones'=>$calificaciones]);


        return Inertia::render('Promedio',['calificaciones'=>$calificaciones,'periodos'=>$periodos]);

    }
}
