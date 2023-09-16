<?php

namespace App\Http\Controllers;
use App\Models\Periodos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeriodoController extends Controller
{
    public function index(Request $request){
        $Periodos=Periodos::all();
        return Inertia::render('Promedio',['calificaciones'=>$request,'periodos'=>$Periodos]);
    }
}
