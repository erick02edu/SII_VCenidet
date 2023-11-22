<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{

    use HasFactory;
    protected $table ='Personal';
    public $timestamps = false;
    protected $fillable=[

        "ApellidoP",
        "ApellidoM",
        "Nombre",
        "RFC",
        "LugarNacimiento",
        "FechaNacimiento",
        "Sexo",
        "EstadoCivil",
        "Direccion",
        "Colonia",
        "CodigoPostal",
        "Ciudad",
        "EntFederativa",
        "Telefono",
        "CURP",
        "CorreoPers",
        "NivEst1",
        "NivEst2",
        "NivEst3",
        "GradoMax1",
        "GradoMax2",
        "GradoMax3",
        "Estudio1",
        "Estudio2",
        "Estudio3",
        "Titulo",
        "Nombramiento",
        "numEmpleado",
        "EstatusEmpleado",
        "Estatus",
        "IngAñoSNEST",
        "IngQuinSNEST",
        "IngAñoGob",
        "IngQuinGob",
        "IngAñoSEP",
        "IngQuinSEP",
        "IngAñoPlan",
        "IngQuinPlan",
        "TipoAct",
        "idPlaza",
        "idUsuario",
        "idDepAdscripcion",
        "idDepAcademico"
        ];
}
