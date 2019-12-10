<?php

namespace App\Http\Controllers;

use App\Seccion;
use Redirect;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeccionController extends Controller
{

  public function index()
  {
      $secciones = DB::table('seccions')->select('seccions.id', 'seccions.codigo_seccion', 'seccions.jornada', 'carreras.nombre as carrera')
      ->leftJoin('carreras','carreras.id','=','seccions.carrera_id')->get();
      $carrera = app('App\Http\Controllers\CarreraController')->show();
      return view('page_admin.seccion', ['secciones' => $secciones, 'carrera' => $carrera]);
  }

  public function show()
  {
      $list_seccion = DB::table('seccions')->get();
      return $list_seccion;
  }

  public function store(Request $request)
  {
    try {
          $seccion = new Seccion;
          $seccion->codigo_seccion = $request->input('codigo');
          $seccion->jornada = $request->input('jornada');
          $seccion->carrera_id = $request->input('carrera');
          $seccion->save();

      Session::flash("message","Felicidades! La sección ha sido agregada con éxito");
      Session::flash("tipe_message","success");
    } catch (Exception $exception) {
        Session::flash("message","Error! La sección no ha sido agregada. Revise sus entradas o intente más tarde.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('ver_seccion');
  }

  public function edit(Request $request)
  {
      try {
        $id = $request->input('id_seccion');
        $seccion = Seccion::find($id);
        $seccion->codigo_seccion = $request->input('codigo');
        $seccion->jornada = $request->input('jornada');
        $seccion->save();
        Session::flash("message","Felicidades! La sección ha sido modificada con éxito");
        Session::flash("tipe_message","success");
    } catch (Exception $exception) {
        Session::flash("message","Error! La sección no ha sido modificada. Revise sus entradas o intente más tarde.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('ver_seccion');
  }

  public function delete(Request $request)
  {
      try{
        $id = $request->input('id_seccion');
        Seccion::destroy($id);
        Session::flash("message","Felicidades! La sección ha sido eliminado con éxito");
        Session::flash("tipe_message","success");
      }catch(Exception $exception){
        Session::flash("message","Error! La sección no ha sido eliminada. Intente más tarde.");
        Session::flash("tipe_message","danger");
      }
      return Redirect()->route('ver_seccion');
  }

  public function seccion_Carrera($id)
  {
      $seccion = DB::table('seccions')->select('seccions.id as id_seccion', 'seccions.codigo_seccion')->where('carrera_id','=',$id)->get();
      foreach ($seccion as $secciones) {
      		$seccionArray[$secciones->id_seccion] = $secciones->codigo_seccion;
      }
      return response()->json($seccionArray);
  }

  
}
