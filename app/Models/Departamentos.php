<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['Nombre','Descripcion','idEncargado','idSubdireccion'];

}
