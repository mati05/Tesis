<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use Exception;
use Auth;
use App\User;
use App\ProyectoTitulo;
use App\Integrante;
use App\Seccion;
use App\EvaluacionProyecto;
use App\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntegranteController extends Controller
{
  public function index(Request $request)
  {
      $list_alumno = app('App\Http\Controllers\AlumnoController')->show();
      $carrera = app('App\Http\Controllers\CarreraController')->show();
      $seccion = app('App\Http\Controllers\SeccionController')->show();
      return view('page_docente.inscripcion_proyecto', ['list_alumno' => $list_alumno, 'carrera' => $carrera ,'seccion' => $seccion]);
  }

  public function store(Request $request)
  {
    try {
          $alumno = $request->input('alumno1');
          $alumno2 = $request->input('alumno2');
          $alumno3 = $request->input('alumno3');
          $nombre_proyecto = $request->input('nombre_proyecto');
          $consulta_proyecto = DB::table('proyecto_titulos')->where('nombre', $nombre_proyecto)->count();
          $consulta_integrante = DB::table('integrantes')->where('user_alumno_id', $alumno)->orWhere('user_alumno_id', $alumno2)
          ->orWhere('user_alumno_id', $alumno3)->count();


        if ($consulta_integrante == 0) {


            if ($consulta_proyecto == 0) {

                  $checkbox = $request->input('nombre_proyecto2');
                  if ($checkbox) {
                    $c = DB::table('proyecto_titulos')->count();
                    $count = date('s');
                    $nombre_proyecto = "Proyecto pendiente".(string)$count.(string)$c;
                    $resultado = app('App\Http\Controllers\ProyectoTituloController')->store($nombre_proyecto, Auth::user()->id);
                  }
                  else{
                    $nombre_proyecto = $request->input('nombre_proyecto');
                    $resultado = app('App\Http\Controllers\ProyectoTituloController')->store($nombre_proyecto, Auth::user()->id);
                  }

                  if ($resultado != 'error') {
                      $integrante = new Integrante;
                      $integrante->user_alumno_id = $alumno;
                      $integrante->proyecto_titulo_id = $resultado;
                      $integrante->user_docente_id = Auth::user()->id;
                      $integrante->save();

                      if (isset($alumno2) and $alumno2 != $alumno) {
                        $integrante2 = new Integrante;
                        $integrante2->user_alumno_id = $alumno2;
                        $integrante2->proyecto_titulo_id = $resultado;
                        $integrante2->user_docente_id = Auth::user()->id;
                        $integrante2->save();
                      }
                      else if (isset($alumno3) and $$alumno3 != $alumno and $alumno3 != $alumno2) {
                        $integrante3 = new Integrante;
                        $integrante3->user_alumno_id = $alumno3;
                        $integrante3->proyecto_titulo_id = $resultado;
                        $integrante3->user_docente_id = Auth::user()->id;
                        $integrante3->save();
                      }
                  }
                  else{
                    Session::flash("message","Error! La inscripción del proyecto no ha sido agregado. Revise sus entradas o intente más tarde.");
                    Session::flash("tipe_message","danger");
                    return Redirect()->route('inscribir_proyecto');
                  }
                  Session::flash("message","Felicidades! La inscripción del proyecto ha sido agregado con éxito");
                  Session::flash("tipe_message","success");
            }else{
              Session::flash("message","Error! El nombre de proyecto ingresado ya existe en nuestros registros. Intente nuevamente.");
              Session::flash("tipe_message","danger");
              return Redirect()->route('inscribir_proyecto');
            }
        }else{
          Session::flash("message","Error! El alumno integrante ya está inscrito en un proyecto. Intente nuevamente.");
          Session::flash("tipe_message","danger");
          return Redirect()->route('inscribir_proyecto');
        }
    } catch (Exception $exception) {
        Session::flash("message","Error! La inscripción del proyecto no ha sido agregado. Revise sus entradas o intente más tarde.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('inscribir_proyecto');
  }



  public function show_listProyect_docente()
  {
      $list_proyectos = DB::table('integrantes')
      ->select('proyecto_titulos.id', 'proyecto_titulos.nombre as proyecto', 'users.run', 'users.nombre as alumno', 'users.apellido')
      ->leftJoin('users','users.id','=','integrantes.user_alumno_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
      ->where('proyecto_titulos.user_docente_id','=', Auth::user()->id)->get();

      return $list_proyectos;
  }


  public function show_statusProyect_alumno()
  {
      $status_proyecto = DB::table('integrantes')
      ->leftJoin('users','users.id','=','integrantes.user_alumno_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
      ->where('users.id','=', Auth::user()->id)
      ->where('proyecto_titulos.ruta_archivo','=','-')->count();

      return $status_proyecto;
  }

  public function show_docenteguia_alumno()
  {
      $status_proyecto = DB::table('integrantes')
      ->leftJoin('users','users.id','=','integrantes.user_alumno_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
      ->where('users.id','=', Auth::user()->id)
      ->where('proyecto_titulos.ruta_archivo','=','-')->count();

      return $status_proyecto;
  }

  public function show_nombreProyect_alumno()
  {
      $nombre_proyecto = DB::table('integrantes')
      ->select('proyecto_titulos.nombre')
      ->leftJoin('users','users.id','=','integrantes.user_alumno_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
      ->where('user_alumno_id','=', Auth::user()->id)->get();

      return $nombre_proyecto;
  }

  public function show_detailProyect_alumno()
  {
      $detalle_proyecto = DB::table('integrantes')
      ->select('proyecto_titulos.id','proyecto_titulos.nombre','users.nombre as nombre_docente','users.apellido as apellido_docente' ,'proyecto_titulos.ruta_archivo','proyecto_titulos.observaciones', 'proyecto_titulos.nombre_archivo')
      ->leftJoin('users','users.id','=','integrantes.user_docente_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
      ->where('user_alumno_id','=', Auth::user()->id)->get();

      return $detalle_proyecto;
  }


  public function show_Integrantes_alumno()
  {
      $integrante1= Integrante::where('user_alumno_id', Auth::user()->id)->first();
      $userIntegrantes = Integrante::where('proyecto_titulo_id',$integrante1['proyecto_titulo_id'])->get();
      $arrayUser = array();
      $i= 0;
      foreach($userIntegrantes as $key){
      $user = User::find($key['user_alumno_id']);
      $arrayUser[$i] = array(
        'nombre'      => $user['nombre'].' '.$user['apellido'],
        'id'          => $user['id']
        );
      $i++;
      }
      $json = json_encode($arrayUser);
      $integrantes = json_decode($json);
      return $integrantes;
  }



  public function show_proyect_docente()
  {
      $list_proyectos = app('App\Http\Controllers\IntegranteController')->mostrar_alumnos_y_proyectos();
      
      return view('page_docente.editar_inscripcion', ['list_proyectos' => $list_proyectos]);
  }


  public function mostrar_alumnos_y_proyectos()
  {
    $proyectos = ProyectoTitulo::where('user_docente_id', Auth::user()->id)->get();
    $array = array();
    $i=0;
    foreach ($proyectos as $key) {
      $integrantes = Integrante::where('proyecto_titulo_id',$key['id'])->get();

      $nombreIntegrantes = '';
      $j=0;
      $users = '';
      $Seccion_codigo = ''; $seccion_id = '';
      $carrera_nombre = ''; $carrera_id = '';
      foreach ($integrantes as $value) {
        if($j != 0){
          $nombreIntegrantes = $nombreIntegrantes.''.', ';
        }
        $user = User::find($value['user_alumno_id']);
        $users = $user;
        $nombreIntegrantes = $nombreIntegrantes.''.$users['nombre'].' '.$users['apellido'];
        $seccion = Seccion::find($users['seccion_id']);
        $Seccion_codigo = $seccion['codigo_seccion'];
        $seccion_id = $seccion['id'];
        $carrera = Carrera::find($seccion['carrera_id']);
        $carrera_nombre = $carrera['nombre'];
        $carrera_id = $carrera['id'];
        $j++;
      }

      
      $evaluacion = EvaluacionProyecto::where('id_proyecto',$key['id'])->get();
        $nota = '';
        $observacion = '';
        $id_eval = '';
         foreach ($evaluacion as $va) {
            $nota = $va['nota'];
            $observacion = $va['observacion'];
            $id_eval = $va['id'];
          }

      $array[$i] = array(
        'proyecto_id' => $key['id'],
        'nombre_proyecto' => $key['nombre'],
        'integrantes' => $nombreIntegrantes,
        'seccion'     => $Seccion_codigo,
        'seccion_id'  => $seccion_id,
        'carrera'     => $carrera_nombre,
        'carrera_id'  => $carrera_id,
        'nota' => $nota,
        'observacion' => $observacion,
        'id_eval' => $id_eval
      );
      $i++;
    }

    $json = json_encode($array);
    $proyectoss = json_decode($json);
    return $proyectoss;
  }


  

  public function edit(Request $request)
  {
      //
  }

  public function destroy(Request $request)
  {
      //
  }
}
