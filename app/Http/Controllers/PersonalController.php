<?php

namespace App\Http\Controllers;

use App\Models\personal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalController extends Controller
{

    public function index()
    {
        $personal=personal::all();

        $plazas=app(PlazaController::class)->ObtenerPlazas();
        $categorias=app(CategoriaController::class)->ObtenerCategorias();

        return Inertia::render('Personal',['personal'=>$personal,'plazas'=>$plazas,'categorias'=>$categorias]); //Regresar a la vista personal
    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
