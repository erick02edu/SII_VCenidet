<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subdireccion extends Model
{
    use HasFactory;
    protected $table ='subdireccion';
    public $timestamps = false;
    protected $fillable=['Nombre'];
}
