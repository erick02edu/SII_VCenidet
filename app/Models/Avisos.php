<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avisos extends Model
{
    use HasFactory;
    protected $table='avisos';
    public $timestamps = false;
    protected $fillable=['Titulo','Descripcion','idUsuario','idRol'];

}
