<?php

namespace App\Http\Controllers;

use App\Models\EstatusEmpleado;
use Illuminate\Http\Request;

class EstatusEmpleadoController extends Controller
{
    public function ObtenerEstatusEmpleados(){
        $EstatusEmpleados=EstatusEmpleado::all();
        return $EstatusEmpleados;
    }

    public function ObtenerEstatusEmpleadosPorID(String $id){
        $EstatusEmpleados=EstatusEmpleado::find($id);
        return $EstatusEmpleados;
    }
}
