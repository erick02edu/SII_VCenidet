<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plaza extends Model //MODELO PARA PLAZAS
{
    use HasFactory;
    protected $fillable=["categoria","horas","estatus","unidad","subunidad","diagonal"];
}
