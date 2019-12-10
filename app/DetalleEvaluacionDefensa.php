<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEvaluacionDefensa extends Model
{
	public $table = "detalle_evaluacion_defensa";

    protected $fillable = [
	    'evaluacion1',
	    'evaluacion2',
	    'evaluacion3',
	    'evaluacion_defensa_id',
	    'user_docente_id',
	    'user_alumno_id',
  	];

  protected $hidden = [

  ];
}
