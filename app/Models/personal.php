<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    use HasFactory;
    protected $table ='Personal';
    public $timestamps = false;
    protected $fillable=["RFC","Nombre","ApellidoP","ApellidoM","FechaNacimiento","numTarjeta","Estatus","Estudio 1","Estudio 2","Estudio 3","idPlaza","idUsuario"];
}
