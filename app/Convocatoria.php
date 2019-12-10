<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
  protected $fillable = [
    'fecha',
    'hora',
    'observaciones',
    'sala',
    'defensa_titulo_id',
  ];

  protected $hidden = [

  ];
}
