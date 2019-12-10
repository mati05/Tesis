<?php

namespace App\Http\Controllers;

use App\User;
use Redirect;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index(Request $request)
  {
       return view('page_admin.usuarios');
  }



  public function show(Request $request)
  {
      $list_admin = app('App\Http\Controllers\AdministrativoController')->show();
      $list_docente = app('App\Http\Controllers\DocenteController')->show();
      $list_alumno = app('App\Http\Controllers\AlumnoController')->show();
      $carrera = app('App\Http\Controllers\CarreraController')->show();
      $seccion = app('App\Http\Controllers\SeccionController')->show();
      return view('page_admin.usuarios', ['list_admin' => $list_admin, 'list_docente' => $list_docente,
        'list_alumno' => $list_alumno, 'carrera' => $carrera ,'seccion' => $seccion]);
  }



  public function store(Request $request)
  {
    try {
      $data = request()->all();
        $existe = $request->input('seccion');
        if (isset($existe)) {
            User::create([
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'run' => $data['run'],
              'nombre' => $data['nombre'],
              'apellido' => $data['apellido'],
              'rol' => $data['rol'],
              'seccion_id' => $data['seccion']
            ]);
        }
        else{
            User::create([
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'run' => $data['run'],
              'nombre' => $data['nombre'],
              'apellido' => $data['apellido'],
              'rol' => $data['rol']
            ]);
        }
      Session::flash("message","Felicidades! El usuario ha sido agregado con éxito");
      Session::flash("tipe_message","success");
    } catch (Exception $exception) {
        Session::flash("message","Error! El usuario no ha sido agregado. Revise sus entradas o intente más tarde.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('usuarios');
  }

  public function run()
  {
    $initUser = User::create([
      'email' => 'alumno_prueba@inacap.cl',
      'password' => bcrypt('123456'),
      'run' => '11111111-1',
      'nombre' => 'Alumno',
      'apellido' => 'Prueba',
      'rol' => 3
    ]);
    $initUser = User::create([
      'email' => 'docente_prueba@inacap.cl',
      'password' => bcrypt('123456'),
      'run' => '222222222-2',
      'nombre' => 'Docente',
      'apellido' => 'Prueba',
      'rol' => 2
    ]);
    $initUser = User::create([
      'email' => 'admin@inacap.cl',
      'password' => bcrypt('123456'),
      'run' => '33333333-3',
      'nombre' => 'Admin',
      'apellido' => 'Admin',
      'rol' => 1
    ]);
  }

  public function edit(Request $request)
  {
    try {

        $id = $request->input('id_editar');
        //$carrera = $request->input('carrera');
        $seccion = $request->input('seccion');

        $user = User::find($id);
        $user->run = $request->input('run');
        $user->email = $request->input('email');
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        if (isset($seccion)) {
            //$user->carrera = $carrera;
            $user->seccion_id = $seccion;
        }


        $user->save();
        Session::flash("message","Felicidades! El usuario ha sido modificado con éxito");
        Session::flash("tipe_message","success");
    } catch (Exception $exception) {
        Session::flash("message","Error! El usuario no ha sido modificado. Revise sus entradas o intente más tarde.");
        Session::flash("tipe_message","danger");
    }
    return Redirect()->route('usuarios');
  }



  public function destroy(Request $request)
  {
      try{
        $id = $request->input('id_eliminar');
        User::destroy($id);
        Session::flash("message","Felicidades! El Usuario ha sido eliminado con éxito");
        Session::flash("tipe_message","success");
      }catch(Exception $exception){
        Session::flash("message","Error! El usuario no ha sido eliminado. Intente más tarde.");
        Session::flash("tipe_message","danger");
      }
      return Redirect()->route('usuarios');
  }
}
