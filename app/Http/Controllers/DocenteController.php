<?php

namespace App\Http\Controllers;

use App\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
  public function index(Request $request)
  {
  	  $count_proyectos = app('App\Http\Controllers\ProyectoTituloController')->show_countProyect_docente();
  	  //$list_proyectos = app('App\Http\Controllers\IntegranteController')->show_listProyect_docente();
  	  $count_proyectos_review = app('App\Http\Controllers\ProyectoTituloController')->show_countProyectReview_docente();
      $list_proyectos = app('App\Http\Controllers\IntegranteController')->mostrar_alumnos_y_proyectos();
      $invitaciones = app('App\Http\Controllers\DefensaTituloController')->show_cant_invitaciones();
      $lista_invitaciones = app('App\Http\Controllers\DefensaTituloController')->show_invitaciones();

      //echo $list_proyectos;
      return view('page_docente.home', ['list_proyectos' => $list_proyectos, 'count_proyectos' => $count_proyectos, 
      	'count_proyectos_review' => $count_proyectos_review, 'invitaciones' => $invitaciones,
        'lista_invitaciones' => $lista_invitaciones]);
  }


  public function reporte()
  {
      $unitaria = app('App\Http\Controllers\NotaController')->index_docente_nota();
      $detalle = app('App\Http\Controllers\NotaController')->index_docente_detalles();
      return view('page_docente.reporte_docente', ['unitaria' => $unitaria, 'detalle' => $detalle]);
  }


  public function show()
  {
      $list_docente = DB::table('users')->where('rol','=', '2')->get();
      return $list_docente;
  }

  public function show_count()
  {
      $count_docente = DB::table('users')->where('rol','=', '2')->count();
      return $count_docente;
  }
}
