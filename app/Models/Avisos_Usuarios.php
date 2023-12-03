<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avisos_Usuarios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='avisos_usuarios';
    protected $fillable=['idAviso','idUsuario'];
}
