<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use Exception;
use Auth;
use App\Integrante;
use App\User;
use App\ProyectoTitulo;
use App\DefensaTitulo;
use App\Convocatoria;
use App\AsistenteInterno;
use App\Mail\DefensaTesisCallReceived;
use Mail;
use App\InfoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DefensaTituloController extends Controller
{
  public function index(Request $request)
  {
      $carrera = app('App\Http\Controllers\CarreraController')->show();
      $list_docente = app('App\Http\Controllers\DocenteController')->show();
      return view('page_docente.inscripcion_defensa', ['carrera' => $carrera, 'list_docente' => $list_docente]);
  }


  public function edit_defensa()
  {
      $lista = app('App\Http\Controllers\IntegranteController')->mostrar_alumnos_y_proyectos();
      return view('page_docente.eliminar_defensa', ['lista' => $lista]);
  }


  public function cargar_alumnos($id_alumno)
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
      $emailIntegrantes = '';
      $j=0;
      $users = '';
      foreach ($integrantes as $value) {
        if($j != 0){
          $nombreIntegrantes = $nombreIntegrantes.''.', ';
          $idIntegrantes = $idIntegrantes.''.', ';
          $emailIntegrantes = $emailIntegrantes.''.', ';
        }
        $user = User::find($value['user_alumno_id']);
        $users = $user;
        $nombreIntegrantes = $nombreIntegrantes.''.$user['nombre'].' '.$user['apellido'];
        $idIntegrantes = $idIntegrantes.''.$user['id'];
        $emailIntegrantes = $emailIntegrantes.''.$user['email'];
        $j++;
      }
      $array[$i] = array(
        'proyecto_id' => $key['id'],
        'nombre_proyecto' => $key['nombre'],
        'integrantes' => $nombreIntegrantes,
        'id_integrantes' => $idIntegrantes,
        'email' => $emailIntegrantes
      );
      $i++;
    }

    $json = json_encode($array);
    $proyectos = json_decode($json);
    return $proyectos;
  }


  public function store(Request $request)
  {
      try {
            $id_proyecto = $request->input('id_proyecto');
            $email_alumno1 = $request->input('email1');
            $email_alumno2 = $request->input('email2');
            $email_alumno3 = $request->input('email3');
            $fecha = $request->input('fecha');
            $horario = $request->input('horario');
            $sala = $request->input('sala');

            $consulta_proyecto = DB::table('defensa_titulos')
            ->where('defensa_titulos.proyecto_id', $id_proyecto)->count();

            if ($consulta_proyecto == 1) {
                  Session::flash("message","Error! La defensa de titulo ingresada ya está en nuestros registros.");
                  Session::flash("tipe_message","danger");
                  return Redirect()->route('inscribir_defensa');
            }
            else{

                $defensa = new DefensaTitulo;
                $defensa->observaciones = "-";
                $defensa->estado = 'en proceso';
                $defensa->proyecto_id = $id_proyecto;
                $defensa->save();
                $id_defensa = $defensa->id;

                  $convocatoria = new Convocatoria;
                  $convocatoria->fecha = $fecha;
                  $convocatoria->hora = $horario;
                  $convocatoria->observaciones = $request->input('observacion');;
                  $convocatoria->sala = $sala;
                  $convocatoria->defensa_titulo_id = $id_defensa;
                  $convocatoria->save();
                  $id_convocatoria = $convocatoria->id;

                  $asistente = new AsistenteInterno;
                  $asistente->user_docente_id = $request->input('docente_inv1');
                  $asistente->convocatoria_id = $id_convocatoria;
                  $asistente->save();

                  $asistente2 = new AsistenteInterno;
                  $asistente2->user_docente_id = $request->input('docente_inv2');
                  $asistente2->convocatoria_id = $id_convocatoria;
                  $asistente2->save();

                  //Datos Defensa Envio de Correos
                  $tesis    = ProyectoTitulo::find($id_proyecto);
                  $proyecto = $tesis['nombre'];
                  $user = User::find($tesis['user_docente_id']);
                  $profesor_guia = $user['nombre'].' '.$user['apellido'];
                  $integrantes = Integrante::where('proyecto_titulo_id',$id_proyecto)->get();
                  foreach ($integrantes as $key) {
                    $user = User::find($key['user_alumno_id']);
                    $nombre = $user['nombre'].' '.$user['apellido'];
                    Mail::to($user['email'])->send(new DefensaTesisCallReceived($nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia));
                  }

                  $user = User::find(Auth::user()->id);
                  $nombre = $user['nombre'].' '.$user['apellido'];
                  Mail::to($user['email'])->send(new DefensaTesisCallReceived($nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia));

                  $user = User::find($request->input('docente_inv1'));
                  $nombre = $user['nombre'].' '.$user['apellido'];
                  Mail::to($user['email'])->send(new DefensaTesisCallReceived($nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia));

                  $user = User::find($request->input('docente_inv2'));
                  $nombre = $user['nombre'].' '.$user['apellido'];
                  Mail::to($user['email'])->send(new DefensaTesisCallReceived($nombre,$fecha,$horario,$sala,$proyecto,$profesor_guia));
                  //FIN envio de correos


                Session::flash("message","Felicidades! La inscripción de defensa de tesis ha sido guardada con éxito");
                Session::flash("tipe_message","success");
            }
      } catch (Exception $exception) {
          Session::flash("message","Error! La inscripción de defensa de tesis no se guardó. Revise sus entradas o intente más tarde.".$exception);
          Session::flash("tipe_message","danger");
      }

    return Redirect()->route('inscribir_defensa');
  }


  public function show_fecha_defensa_alumno()
  {
      $fecha_defensa = DB::table('convocatorias')
      ->select('convocatorias.fecha', 'convocatorias.hora')
      ->leftJoin('defensa_titulos','defensa_titulos.id','=','convocatorias.defensa_titulo_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','defensa_titulos.proyecto_id')
      ->leftJoin('integrantes','integrantes.proyecto_titulo_id','=','proyecto_titulos.id')
      ->where('integrantes.user_alumno_id','=', Auth::user()->id)->get();

      return $fecha_defensa;
  }


  public function show_invitaciones()
  {
      $lista_asistencia = DB::table('asistente_internos')
      ->select('convocatorias.fecha', 'convocatorias.hora', 'convocatorias.sala', 'proyecto_titulos.nombre')
      ->leftJoin('convocatorias','convocatorias.id','=','asistente_internos.convocatoria_id')
      ->leftJoin('defensa_titulos','defensa_titulos.id','=','convocatorias.defensa_titulo_id')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','defensa_titulos.proyecto_id')
      ->where('asistente_internos.user_docente_id','=', Auth::user()->id)->get();

      return $lista_asistencia;
  }

  public function show_cant_invitaciones()
  {
      $asistencia = DB::table('asistente_internos')
      ->leftJoin('convocatorias','convocatorias.id','=','asistente_internos.convocatoria_id')
      ->where('asistente_internos.user_docente_id','=', Auth::user()->id)->count();

      return $asistencia;
  }

  public function destroy(Request $request)
  {
      try{
            $id_proyecto = $request->input('id_eliminar');
            $validar = DB::table('defensa_titulos')->where('proyecto_id', $id_proyecto)->count();
            $defensa = DB::table('defensa_titulos')->where('proyecto_id', $id_proyecto)->get();

          if ($validar == 1) {
           
            $id_defensa = '';
            foreach ($defensa as $key) {
                $id_defensa = $key->id;
            }

            $convocatoria = DB::table('convocatorias')->where('defensa_titulo_id', $id_defensa)->get();
            $id_convocatoria = '';
            foreach ($convocatoria as $key) {
                $id_convocatoria = $key->id;
            }
            DB::table('asistente_internos')->where('convocatoria_id', $id_convocatoria)->delete();
            DB::table('convocatorias')->where('defensa_titulo_id', $id_defensa)->delete();

            $evaluacion_defensas = DB::table('evaluacion_defensas')->where('defensa_titulo_id', $id_defensa)->get();
            $id_evaluacion_defensa = '';
            foreach ($evaluacion_defensas as $key) {
                $id_evaluacion_defensa = $key->id;
            }

            DB::table('detalle_evaluacion_defensa')->where('evaluacion_defensa_id', $id_evaluacion_defensa)->delete();
            DB::table('evaluacion_defensas')->where('defensa_titulo_id', $id_defensa)->delete();
            DB::table('defensa_titulos')->where('proyecto_id', $id_proyecto)->delete();
          }
          else{
              Session::flash("message","Error! ya se ha eliminado la defensa de tesis para este proyecto");
              Session::flash("tipe_message","danger");
              return Redirect()->route('lista_defensa');
          }

            Session::flash("message","Felicidades! La defensa de titulo, junto a sus integrantes y evaluaciónes se han eliminado con éxito");
            Session::flash("tipe_message","success");

        }catch(Exception $exception){
            Session::flash("message","Error! no se ha podido eliminar la defensa de titulo. Intente más tarde.");
            Session::flash("tipe_message","danger");
        }
      return Redirect()->route('lista_defensa');
  }
}
