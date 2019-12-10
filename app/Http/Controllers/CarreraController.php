<?php

namespace App\Http\Controllers;

use App\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarreraController extends Controller
{
  public function show()
  {
      $list_carrera = DB::table('carreras')->get();
      return $list_carrera;
  }
}
