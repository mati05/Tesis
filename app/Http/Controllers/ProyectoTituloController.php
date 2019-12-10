<?php

namespace App\Http\Controllers;

use Redirect;
use File;
use Session;
use Storage;
use Exception;
use Auth;
use App\ProyectoTitulo;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoTituloController extends Controller
{
  public function index(Request $request)
  {
      $detalle_proyecto = app('App\Http\Controllers\IntegranteController')->show_detailProyect_alumno();
      return view('page_alumno.proyecto', ['detalle_proyecto' => $detalle_proyecto]);
  }

  public function store($nombre, $docente)
  {
    try {
          $proyecto = new ProyectoTitulo;
          $proyecto->nombre = $nombre;
          $proyecto->observaciones = "-";
          $proyecto->nombre_archivo = "-";
          $proyecto->ruta_archivo = "-";
          $proyecto->user_docente_id = $docente;
          $proyecto->save();
          $id = $proyecto->id;
        
    } catch (Exception $exception) {
        $id = "error";
    }
    return $id;
  }

  public function show_countProyect_docente()
  {
      $count_proyectos = DB::table('proyecto_titulos')
      ->where('proyecto_titulos.user_docente_id','=', Auth::user()->id)->count();

      return $count_proyectos;
  }

  public function show_countProyectReview_docente()
  {
      $count_proyectos_review = DB::table('proyecto_titulos')
      ->where('proyecto_titulos.user_docente_id','=', Auth::user()->id)->where('proyecto_titulos.ruta_archivo','!=','-')->count();

      return $count_proyectos_review;
  }


  public function show_countProyect_total()
  {
      $count_proyectos_total = DB::table('proyecto_titulos')->count();
      return $count_proyectos_total;
  }

  public function edit(Request $request)
  {
    try {
          $id = $request->input('id_proyecto');
          $nombre_proyecto = $request->input('nombre_proyecto');
          $observacion = $request->input('observacion');
          $archivo = $request->file('archivo');
          $consulta_proyecto = DB::table('integrantes')
          ->leftJoin('proyecto_titulos','proyecto_titulos.id','=','integrantes.proyecto_titulo_id')
          ->where('proyecto_titulos.nombre', $nombre_proyecto)
          ->where('integrantes.user_alumno_id', Auth::user()->id)->count();

          $consulta_proyecto2 = DB::table('proyecto_titulos')
          ->where('proyecto_titulos.nombre', $nombre_proyecto)->count();

          if ($consulta_proyecto == 1 or $consulta_proyecto == 0 and $consulta_proyecto2 == 0 ) 
          {
            $proyecto = ProyectoTitulo::find($id);
            $proyecto->nombre = $nombre_proyecto;
            $proyecto->observaciones = $observacion;
            if (isset($archivo)) {
                $archivo->move(public_path().'/uploads', $nombre_proyecto.".pdf");
                $proyecto->nombre_archivo = $nombre_proyecto;
                $proyecto->ruta_archivo = public_path().'/uploads';
            }
            $proyecto->save();
          }
          else {
            Session::flash("message","Error! El nombre de proyecto ingresado ya existe en nuestros registros. Intente nuevamente.");
            Session::flash("tipe_message","danger");
            return Redirect()->route('proyecto_titulo');
          }
        Session::flash("message","Felicidades! El proyecto de título ha sido modificado con éxito ");
        Session::flash("tipe_message","success");

    } catch (Exception $exception) {
        Session::flash("message","Error! El proyecto de título no se pudo modificar. Intente nuevamente.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('proyecto_titulo');
  }


  public function download_informe($r){
      $informe = ProyectoTitulo::find($r);
      $ruta = $informe->ruta_archivo.'/'.$informe->nombre_archivo.'.pdf';
      if ($informe->ruta_archivo == '-') {

            Session::flash("message","Error! El proyecto de título aún no posee informe");
            Session::flash("tipe_message","danger");
            return Redirect()->route('lista_proyecto');
      }else{
            return Response::download($ruta);
      }
    }

  public function show_nombreDocente($proyecto)
  {
      $nombre_docente = DB::table('proyecto_titulos')
      ->select('users.nombre as nombre', 'users.apellido as apellido')
      ->leftJoin('users','users.id','=','proyecto_titulos.user_docente_id')
      ->where('proyecto_titulos.nombre','=', $proyecto)->get();

      return $nombre_docente;
  }

  public function destroy(Request $request)
  {
      
  }
}
