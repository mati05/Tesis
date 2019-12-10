<?php

namespace App\Http\Controllers;

//use App\Administrativo;
use App\User;
use Redirect;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministrativoController extends Controller
{
  public function index(Request $request)
  {
  		$count_alumnos = app('App\Http\Controllers\AlumnoController')->show_count();
  		$count_docentes = app('App\Http\Controllers\DocenteController')->show_count();
  		$count_total_proyecto = app('App\Http\Controllers\ProyectoTituloController')->show_countProyect_total();
    	return view('page_admin.home', ['count_alumnos' => $count_alumnos, 'count_docentes' => $count_docentes, 
    		'count_total_proyecto' => $count_total_proyecto]);
  }

  public function show()
  {
      $list_admin = DB::table('users')->where('rol','=', '1')->get();
      return $list_admin;
  }

  public function reporte(Request $request)
  {
      $unitaria = app('App\Http\Controllers\NotaController')->index_admin_nota();
      $detalle = app('App\Http\Controllers\NotaController')->index_admin_detalles();

      return view('page_admin.reporte_admin', ['unitaria' => $unitaria, 'detalle' => $detalle]);
  }
  
}
