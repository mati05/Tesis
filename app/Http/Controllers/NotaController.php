<?php

namespace App\Http\Controllers;
use Redirect;
use Session;
use Exception;
use Auth;
use App\Nota;
use App\EvaluacionDefensa;
use App\DetalleEvaluacionDefensa;
use App\User;
use App\ProyectoTitulo;
use App\Integrante;
use Illuminate\Http\Request;

class NotaController extends Controller
{
  public function index_docente_nota()
  {
   
    $e_modificado = array();
    $j            = 0;
    $i            = 0;
    
        $user               = User::find(Auth::user()->id);
        $nombre             = $user['nombre'].' '.$user['apellido'];
        $evaluacion_defensa = EvaluacionDefensa::where('user_docente_id', Auth::user()->id)->get();
        foreach ($evaluacion_defensa as $value) {
          $user                     = User::find($value['user_alumno_id']);
          $value['user_docente_id'] = $nombre;
          $value['user_alumno_id']  = $user['nombre'].' '.$user['apellido'];
          $e_modificado[$j]         = $value;
          $j++;
        }
      
   
    $json = json_encode($e_modificado);
    $respuesta = json_decode($json);

    return $respuesta;
  }


  public function index_docente_detalles()
  {
   
      $d_modificado = array();
      $j            = 0;
      $i            = 0;
  
      $user               = User::find(Auth::user()->id);
      $nombre             = $user['nombre'].' '.$user['apellido'];
      $detalle_defensa = DetalleEvaluacionDefensa::where('user_docente_id', Auth::user()->id)->get();
      foreach ($detalle_defensa as $value) {
        $user                     = User::find($value['user_alumno_id']);
        $value['user_docente_id'] = $nombre;
        $value['user_alumno_id']  = $user['nombre'].' '.$user['apellido'];
        $d_modificado[$i]         = $value;
        $i++;
      }
    
    $json = json_encode($d_modificado);
    $respuesta = json_decode($json);
    return $respuesta;
  }


  public function index_alumno_nota()
  {

    $e_modificado = array();
    $d_modificado = array();
    $j            = 0;
    $i            = 0;
    $user               = User::find(Auth::user()->id);
    $nombre             = $user['nombre'].' '.$user['apellido'];
    $evaluacion_defensa = EvaluacionDefensa::where('user_alumno_id', Auth::user()->id)->get();
    foreach ($evaluacion_defensa as $value) {
      $user                     = User::find($value['user_docente_id']);
      $value['user_docente_id'] = $user['nombre'].' '.$user['apellido'];
      $value['user_alumno_id']  = $nombre;
      $e_modificado[$j]         = $value;
      $j++;
    }
    $json = json_encode($e_modificado);
    $respuesta = json_decode($json);

    return $respuesta;
  }

  public function index_alumno_detalles()
  {

    $e_modificado = array();
    $d_modificado = array();
    $j            = 0;
    $i            = 0;
    $user               = User::find(Auth::user()->id);
    $nombre             = $user['nombre'].' '.$user['apellido'];
    $detalle_defensa = DetalleEvaluacionDefensa::where('user_alumno_id', Auth::user()->id)->get();
    foreach ($detalle_defensa as $value) {
      $user                     = User::find($value['user_docente_id']);
      $value['user_docente_id'] = $user['nombre'].' '.$user['apellido'];
      $value['user_alumno_id']  = $nombre;
      $d_modificado[$i]         = $value;
      $i++;
    }
    $json = json_encode($d_modificado);
    $respuesta = json_decode($json);

    return $respuesta;
  }

  
  public function index_admin_nota()
  {
    $e_modificado = array();
    $j            = 0;
    $evaluacion_defensa = EvaluacionDefensa::all();
    foreach ($evaluacion_defensa as $value) {
      $alumno                   = User::find($value['user_alumno_id']);
      $docente                  = User::find($value['user_docente_id']);
      $value['user_docente_id'] = $docente['nombre'].' '.$docente['apellido'];
      $value['user_alumno_id']  = $alumno['nombre'].' '.$alumno['apellido'];
      $e_modificado[$j]         = $value;
      $j++;
    }
      
    $json = json_encode($e_modificado);
    $respuesta = json_decode($json);

    return $respuesta;
  }


  public function index_admin_detalles()
  {
      $d_modificado = array();
      $i            = 0;
  
      $detalle_defensa = DetalleEvaluacionDefensa::all();
      foreach ($detalle_defensa as $value) {
        $alumno                   = User::find($value['user_alumno_id']);
        $docente                  = User::find($value['user_docente_id']);
        $value['user_docente_id'] = $docente['nombre'].' '.$docente['apellido'];
        $value['user_alumno_id']  = $alumno['nombre'].' '.$alumno['apellido'];
        $d_modificado[$i]         = $value;
        $i++;
      }
    
    $json = json_encode($d_modificado);
    $respuesta = json_decode($json);
    return $respuesta;
  }
}
