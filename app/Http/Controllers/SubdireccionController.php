<?php

namespace App\Http\Controllers;

use App\Models\subdireccion;
use Illuminate\Http\Request;

class SubdireccionController extends Controller
{
    public function ObtenerSubdirecciones(){
        $subdireccion=subdireccion::all();
        return $subdireccion;
    }
}
