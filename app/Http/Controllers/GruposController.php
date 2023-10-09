<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use Illuminate\Http\Request;
use Inertia\Inertia;


class GruposController extends Controller
{

    public function index()
    {
        
    }

    public function store(Request $request)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {

    }

    public function ObtenerGrupos(){
        $Grupos=Grupos::all();
        return $Grupos;
    }
}
