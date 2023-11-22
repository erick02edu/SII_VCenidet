<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasHorario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='diashorario';
    protected $fillable=['dia','HInicio','HFin','idHorario'];
}
