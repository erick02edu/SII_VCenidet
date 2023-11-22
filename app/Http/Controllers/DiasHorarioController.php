<?php

namespace App\Http\Controllers;

use App\Models\DiasHorario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiasHorarioController extends Controller
{

    public function store(Request $request){
        $idHorario = $request->input('idHorario');
        $DiasEliminar = DiasHorario::where('idHorario', $idHorario)->get();

        //Eliminar dias
        if(count($DiasEliminar)!=0){
            foreach($DiasEliminar as $dias){
                $dias->delete();
            }
        }

        try{
            //Registrar el dia de lunes
            $nuevosDiasLunes = $request->input('NuevoDiaLunes');
            if($nuevosDiasLunes!=null){
                foreach ($nuevosDiasLunes as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            //Registrar el dia de martes
            $nuevosDiasMartes = $request->input('NuevoDiaMartes');
            if($nuevosDiasMartes!=null){
                foreach ($nuevosDiasMartes as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            //Registrar el dia de miercoles
            $nuevosDiasMiercoles = $request->input('NuevoDiaMiercoles');
            if($nuevosDiasMiercoles!=null){
                foreach ($nuevosDiasMiercoles as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            //Registrar el dia de jueves
            $nuevosDiasJueves = $request->input('NuevoDiaJueves');
            if($nuevosDiasJueves!=null){
                foreach ($nuevosDiasJueves as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            //Registrar el dia de Viernes
            $nuevosDiasViernes = $request->input('NuevoDiaViernes');
            if($nuevosDiasViernes!=null){
                foreach ($nuevosDiasViernes as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            //Registrar el dia de Sabado
            $nuevosDiasSabado = $request->input('NuevoDiaSabado');
            if($nuevosDiasSabado!=null){
                foreach ($nuevosDiasSabado as $dia) {
                    $Dia=new DiasHorario();
                    $Dia->HInicio=$dia['HInicio'];
                    $Dia->HFin=$dia['HFin'];
                    $Dia->dia=$dia['dia'];
                    $Dia->idHorario=$idHorario;
                    $Dia->save();
                }
            }

            Session::flash('mensaje', 'Se ha guardado los cambios del horario correctamente');
            Session::flash('TipoMensaje', 'Exitoso');
            return redirect()->route('HorariosDocentes.index');

        }
        catch(Exception){
            Session::flash('mensaje', 'Ha ocurrido un error al guardar los cambios del horario');
            Session::flash('TipoMensaje', 'Error');
            return redirect()->route('HorariosDocentes.index');
        }

    }

    public function ObtenerDiasHorario(String $dia,String $idHorario){
        $Dias=DiasHorario::where('dia', $dia)->where('idHorario',$idHorario)->get();

        foreach ($Dias as $Dia) {
            $Dia->HInicio = date('H:i', strtotime($Dia->HInicio));
            $Dia->HFin = date('H:i', strtotime($Dia->HFin));
        }

        return $Dias;
    }


}
