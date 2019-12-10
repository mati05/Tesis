<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoTitulo extends Model
{
  protected $fillable = [
    'nombre',
    'nombre_archivo',
    'ruta_archivo',
    'observaciones',
    'user_docente_id',
  ];

  protected $hidden = [

  ];
}
