<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plaza extends Model //MODELO PARA PLAZAS
{
    use HasFactory;
    protected $fillable=["idCategoria","horas","estatus","unidad","subunidad","diagonal"];
}
