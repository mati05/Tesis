<?php

namespace App\Http\Controllers;

use Redirect;
use Session;
use Exception;
use Auth;
use App\EvaluacionProyecto;
use App\ProyectoTitulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluacionProyectoController extends Controller
{
  public function index(Request $request)
  {
      //
  }

  public function store(Request $request)
  {
      try {
          $id_proyecto = $request->input('id_evaluar');

          $consulta_proyecto = DB::table('evaluacion_proyectos')
          ->where('evaluacion_proyectos.id_proyecto', $id_proyecto)->count();

          if ($consulta_proyecto == 1) {
              Session::flash("message","Error! El proyecto ya ha sido evaluado");
              Session::flash("tipe_message","danger");
              return Redirect()->route('lista_proyecto');
          }
          else{
              $evaluacion = new EvaluacionProyecto;
              $evaluacion->nota = $request->input('nota');
              $evaluacion->observacion = $request->input('observacion');
              $evaluacion->id_proyecto = $id_proyecto;
              $evaluacion->save();
            Session::flash("message","Felicidades! El proyecto ha sido evaluado con éxito");
            Session::flash("tipe_message","success");
          }

      } catch (Exception $exception) {
          Session::flash("message","Error! No se pudo evaluar el proyecto. Revise sus entradas o intente más tarde.");
          Session::flash("tipe_message","danger");
      }

    return Redirect()->route('lista_proyecto');
  }

  public function show_status_proyect($proyecto)
  {
      $status_proyecto = DB::table('evaluacion_proyectos')
      ->select('evaluacion_proyectos.nota')
      ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','evaluacion_proyectos.id_proyecto')
      ->where('proyecto_titulos.nombre','=', $proyecto)->get();

      return $status_proyecto;
  }

  public function edit(Request $request)
  {
      try {
            $id_eval = $request->input('id_eval');
            $evaluacion = EvaluacionProyecto::find($id_eval);
            $evaluacion->nota = $request->input('nota');
            $evaluacion->observacion = $request->input('observacion');
            $evaluacion->save();
            Session::flash("message","Felicidades! La evaluacion del proyecto ha sido modificada con éxito");
            Session::flash("tipe_message","success");

      } catch (Exception $exception) {
            Session::flash("message","Error! No se pudo modificar la evaluacion del proyecto. Revise sus entradas o intente más tarde.");
            Session::flash("tipe_message","danger");
      }

    return Redirect()->route('lista_proyecto');
  }

  public function destroy(Request $request)
  {
       try{
            $id_proyecto = $request->input('id_eliminar');
            $id_evaluacion = $request->input('id_eval_eliminar');
            EvaluacionProyecto::destroy($id_evaluacion);
            DB::table('integrantes')->where('integrantes.proyecto_titulo_id', $id_proyecto)->delete();
            

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
            ProyectoTitulo::destroy($id_proyecto);

            Session::flash("message","Felicidades! El proyecto de titulo, junto a sus integrantes y evaluación se han eliminado con éxito");
            Session::flash("tipe_message","success");

        }catch(Exception $exception){
            Session::flash("message","Error! no se ha podido eliminar el proyecto. Intente más tarde.");
            Session::flash("tipe_message","danger");
        }
      return Redirect()->route('lista_proyecto');
  }
}
