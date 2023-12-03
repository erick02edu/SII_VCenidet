<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bajasPersonal extends Model
{
    use HasFactory;
    protected $table='bajaspersonal';
    public $timestamps = false;
    protected $fillable=['idPersonal','idEstatus','FechaBaja'];
}
