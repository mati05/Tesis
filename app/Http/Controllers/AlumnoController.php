<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
  public function index(Request $request)
  {
      $status_proyecto = app('App\Http\Controllers\IntegranteController')->show_statusProyect_alumno();
      $nombre_proyecto = app('App\Http\Controllers\IntegranteController')->show_nombreProyect_alumno();
      $integrantes = app('App\Http\Controllers\IntegranteController')->show_Integrantes_alumno();
      $fecha_tesis = app('App\Http\Controllers\DefensaTituloController')->show_fecha_defensa_alumno();

      $proyecto = '';
      foreach ($nombre_proyecto as $key) {
          $proyecto = $key->nombre;
      }

      $nombre_docente = app('App\Http\Controllers\ProyectoTituloController')->show_nombreDocente($proyecto);
      $evaluado = app('App\Http\Controllers\EvaluacionProyectoController')->show_status_proyect($proyecto);

      return view('page_alumno.home', ['status_proyecto' => $status_proyecto, 'nombre_proyecto' => $nombre_proyecto, 
        'integrantes' => $integrantes, 'docente' => $nombre_docente, 'evaluado' => $evaluado, 
        'fecha_tesis' => $fecha_tesis]);
  }


  public function show()
  {
      $list_alumno = DB::table('users')->select('users.id', 'users.nombre', 'run', 'apellido', 'email', 'codigo_seccion', 'carreras.nombre as carrera')->leftJoin('seccions','seccions.id','=','users.seccion_id')->leftJoin('carreras','carreras.id','=','seccions.carrera_id')->where('rol','=', '3')->get();
      return $list_alumno;
  }

  public function show_count()
  {
      $count_alumno = DB::table('users')->where('rol','=', '3')->count();
      return $count_alumno;
  }

  public function reporte(Request $request)
  {
      $unitaria = app('App\Http\Controllers\NotaController')->index_alumno_nota();
      $detalle = app('App\Http\Controllers\NotaController')->index_alumno_detalles();

      return view('page_alumno.reporte', ['unitaria' => $unitaria, 'detalle' => $detalle]);
  }

  public function seccion_Alumno($id)
  {
      $alumnos = DB::table('users')->select('users.id as id_alumno', 'users.nombre', 'users.apellido')->where('seccion_id','=',$id)->get();

        foreach ($alumnos as $alumno) {
          $alumnoArray[$alumno->id_alumno] = $alumno->nombre." ".$alumno->apellido;
        }
      return response()->json($alumnoArray);
  }
}
