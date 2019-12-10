<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
  protected $fillable = [
    'codigo_rubrica',
    'descripcion',
  ];

  protected $hidden = [

  ];
}
