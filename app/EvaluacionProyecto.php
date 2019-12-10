<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionProyecto extends Model
{
  protected $fillable = [
    'nota',
    'id_proyecto',
    'observacion',
  ];

  protected $hidden = [

  ];
}
