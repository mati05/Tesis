<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefensaTitulo extends Model
{
  protected $fillable = [
    'observaciones',
    'estado',
    'proyecto_id',
  ];

  protected $hidden = [

  ];
}
