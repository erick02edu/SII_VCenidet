<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisosCarreras extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='permisoscarreras';
    protected $fillable=["idCarrera","idUsuario"];
}
