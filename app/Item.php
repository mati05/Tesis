<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = [
    'nombre',
    'ponderacion',
    'categoria_id',
    'rubrica_id',
  ];

  protected $hidden = [

  ];
}
