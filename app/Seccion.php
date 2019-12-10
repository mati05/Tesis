<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
  protected $fillable = [
    'codigo_seccion',
    'jornada',
    'carrera_id',
  ];

  protected $hidden = [

  ];
}
