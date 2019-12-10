<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenteInterno extends Model
{
  protected $fillable = [
    'user_docente_id',
    'convocatoria_id',
  ];

  protected $hidden = [

  ];
}
