<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
  protected $fillable = [
    'nombre',
    'descripcion',
    'ponderacion',
    'item_id',
  ];

  protected $hidden = [

  ];
}
