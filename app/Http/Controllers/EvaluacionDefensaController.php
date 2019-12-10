<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use Exception;
use Auth;
use App\EvaluacionDefensa;
use App\Integrante;
use App\User;
use App\DefensaTitulo;
use App\DetalleEvaluacionDefensa;
use App\ProyectoTitulo;
use App\Convocatoria;
use App\AsistenteInterno;
use App\EvaluacionProyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluacionDefensaController extends Controller
{
  public function index(Request $request)
  {
      $carrera = app('App\Http\Controllers\CarreraController')->show();
      return view('page_docente.evaluar_defensa', ['carrera' => $carrera]);
  }

  public function store(Request $request)
  {
      try {
            $id_defensa = $request->input('id_defensa');
            $alumno1 = $request->input('alumno1');
            $alumno2 = $request->input('alumno2');
            $alumno3 = $request->input('alumno3');
            $nota_eva_expo = $request->input('nota_eva_expo');
            $nota_eva_demo = $request->input('nota_eva_demo');
            $nota_eva_perso1 = $request->input('nota_eva_perso1');
            $nota_eva_perso2 = $request->input('nota_eva_perso2');
            $nota_eva_perso3 = $request->input('nota_eva_perso3');
            $nota_final_a1 = $request->input('nota_final_a1');
            $nota_final_a2 = $request->input('nota_final_a2');
            $nota_final_a3 = $request->input('nota_final_a3');


            $consulta_proyecto = DB::table('evaluacion_defensas')
            ->where('defensa_titulo_id', $id_defensa)->count();

            if ($consulta_proyecto == 1) {
              Session::flash("message","Error! La defensa de tesis ingresada ya ha sido evaluada");
              Session::flash("tipe_message","danger");
              return Redirect()->route('evaluar_defensa');
            }
            else{
                $evaluacion = new EvaluacionDefensa;
                $evaluacion->nota = $nota_final_a1;
                $evaluacion->user_docente_id = Auth::user()->id;
                $evaluacion->user_alumno_id = $alumno1;
                $evaluacion->defensa_titulo_id = $id_defensa;
                $evaluacion->save();
                $id_evaluacion = $evaluacion->id;

                //guardar detalle evaluacion
                $detalle_evaluacion = new DetalleEvaluacionDefensa;
                $detalle_evaluacion->evaluacion1 = $nota_eva_expo;
                $detalle_evaluacion->evaluacion2 = $nota_eva_demo;
                $detalle_evaluacion->evaluacion3 = $nota_eva_perso1;
                $detalle_evaluacion->evaluacion_defensa_id = $id_evaluacion;
                $detalle_evaluacion->user_docente_id = Auth::user()->id;
                $detalle_evaluacion->user_alumno_id = $alumno1;
                $detalle_evaluacion->save();

                
                if (isset($alumno2)) {
                    $evaluacion_2 = new EvaluacionDefensa;
                    $evaluacion_2->nota = $nota_final_a2;
                    $evaluacion_2->user_docente_id = Auth::user()->id;
                    $evaluacion_2->user_alumno_id = $alumno2;
                    $evaluacion_2->defensa_titulo_id = $id_defensa;
                    $evaluacion_2->save();
                    $id_evaluacion2 = $evaluacion_2->id;

                     //guardar detalle evaluacion
                      $detalle_evaluacion2 = new DetalleEvaluacionDefensa;
                      $detalle_evaluacion2->evaluacion1 = $nota_eva_expo;
                      $detalle_evaluacion2->evaluacion2 = $nota_eva_demo;
                      $detalle_evaluacion2->evaluacion3 = $nota_eva_perso2;
                      $detalle_evaluacion2->evaluacion_defensa_id = $id_evaluacion2;
                      $detalle_evaluacion2->user_docente_id = Auth::user()->id;
                      $detalle_evaluacion2->user_alumno_id = $alumno2;
                      $detalle_evaluacion2->save();
                }


                if (isset($alumno3)) {
                    $evaluacion_3 = new EvaluacionDefensa;
                    $evaluacion_3->nota = $nota_final_a3;
                    $evaluacion_3->user_docente_id = Auth::user()->id;
                    $evaluacion_3->user_alumno_id = $alumno3;
                    $evaluacion_3->defensa_titulo_id = $id_defensa;
                    $evaluacion_3->save();
                    $id_evaluacion3 = $evaluacion_3->id;

                    //guardar detalle evaluacion
                      $detalle_evaluacion3 = new DetalleEvaluacionDefensa;
                      $detalle_evaluacion3->evaluacion1 = $nota_eva_expo;
                      $detalle_evaluacion3->evaluacion2 = $nota_eva_demo;
                      $detalle_evaluacion3->evaluacion3 = $nota_eva_perso3;
                      $detalle_evaluacion3->evaluacion_defensa_id = $id_evaluacion3;
                      $detalle_evaluacion3->user_docente_id = Auth::user()->id;
                      $detalle_evaluacion3->user_alumno_id = $alumno3;
                      $detalle_evaluacion3->save();
                }



                Session::flash("message","Felicidades! La evaluacion para defensa de tesis se guardó con éxito ");
                Session::flash("tipe_message","success");
            }

      } catch (Exception $exception) {
        Session::flash("message","Error! La evaluacion de tesis no se ha logrado guardar. Revise sus entradas o intente más tarde.".$exception);
        Session::flash("tipe_message","danger");
      }
    return Redirect()->route('evaluar_defensa');
  }


  public function cargar_evaluacion($id_alumno)
  {
    $usuario = Integrante::where('user_alumno_id',$id_alumno)->get();
    $proyectos = '';
    foreach ($usuario as $key) {
      $proyectos = ProyectoTitulo::where('user_docente_id', $key['user_docente_id'])->where('id', $key['proyecto_titulo_id'])->get();
    }

    $array = array();
    $i=0;
    foreach ($proyectos as $key) {
      $integrantes = Integrante::where('proyecto_titulo_id',$key['id'])->get();

      $nombreIntegrantes = '';
      $idIntegrantes = '';
      $invitados = '';
      $nota_proyecto = '';
      $id_defensa = '';
      $id_convocatoria = '';
      $asistente = '';
      $j=0;
      $users = '';
      foreach ($integrantes as $value) {
        if($j != 0){
          $nombreIntegrantes = $nombreIntegrantes.''.', ';
          $idIntegrantes = $idIntegrantes.''.', ';
        }
        $user = User::find($value['user_alumno_id']);
        $eva_proyecto = EvaluacionProyecto::where('id_proyecto',$key['id'])->get();
          foreach ($eva_proyecto as $p) {
              $nota_proyecto = $p['nota'];
          }

        $defensa = DefensaTitulo::where('proyecto_id',$key['id'])->get();
          foreach ($defensa as $d) {
              $id_defensa = $d['id'];
          }

        $convocatoria = Convocatoria::where('defensa_titulo_id',$id_defensa)->get();
          foreach ($convocatoria as $c) {
              $id_convocatoria = $c['id'];
          }

        $asistente_interno = AsistenteInterno::where('convocatoria_id',$id_convocatoria)->where('user_docente_id',Auth::user()->id)->get();
          foreach ($asistente_interno as $a) {
              $asistente = $a['user_docente_id'];
          }
        $users = $user;
        $nombreIntegrantes = $nombreIntegrantes.''.$user['nombre'].' '.$user['apellido'];
        $idIntegrantes = $idIntegrantes.''.$user['id'];
        $j++;
      }
      $array[$i] = array(
        'proyecto_id' => $key['id'],
        'nombre_proyecto' => $key['nombre'],
        'integrantes' => $nombreIntegrantes,
        'id_integrantes' => $idIntegrantes,
        'nota_proyecto' => $nota_proyecto,
        'defensa' => $id_defensa,
        'asistente' => $asistente,
        'docente_guia' => $key['user_docente_id']
      );
      $i++;
    }

    $json = json_encode($array);
    $proyectos = json_decode($json);
    return $proyectos;
  }

  public function show(Request $request)
  {
      //
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
