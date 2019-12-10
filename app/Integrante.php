<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
  protected $fillable = [
    'user_alumno_id',
    'proyecto_titulo_id',
    'user_docente_id',
  ];

  protected $hidden = [

  ];
}
