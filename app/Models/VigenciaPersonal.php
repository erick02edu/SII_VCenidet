<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VigenciaPersonal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="vigenciapersonal";
    protected $fillable=['idPersonal','idPeriodo','InicioVigencia','FinVigencia'];
}
