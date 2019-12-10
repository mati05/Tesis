<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenteExterno extends Model
{
  protected $fillable = [
    'nombre',
    'apellido',
    'email',
    'convocatoria_id',
  ];

  protected $hidden = [

  ];
}
