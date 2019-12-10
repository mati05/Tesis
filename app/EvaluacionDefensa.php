<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDefensa extends Model
{
  protected $fillable = [
    'nota',
    'user_docente_id',
    'user_alumno_id',
    'defensa_titulo_id',
  ];

  protected $hidden = [

  ];
}
