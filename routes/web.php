<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['prefix' => 'Errors'], function() {
    Route::get('401', function(){
      return view('template.401');
    })->name('401');
});

Route::get('inicializar', 'UsuarioController@run');
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'Administrativo','middleware' => 'administrativo'], function (){
    Route::get('home', 'AdministrativoController@index')->name('home_admin');
    Route::get('seccion', 'SeccionController@index')->name('ver_seccion');
    Route::post('seccion/agregacion','SeccionController@store')->name('add_seccion');
    Route::post('seccion/edicion','SeccionController@edit')->name('edit_seccion');
    Route::post('seccion/eliminacion','SeccionController@delete')->name('delete_seccion');
    Route::get('usuarios', 'UsuarioController@show')->name('usuarios');
    Route::post('usuarios/agregar','UsuarioController@store')->name('add_usuario');
    Route::post('usuarios/eliminar','UsuarioController@destroy')->name('delete_usuario');
    Route::post('usuarios/modificar','UsuarioController@edit')->name('edit_usuario');
    Route::get('seccionPorCarreraAlumno/{id}', 'SeccionController@seccion_Carrera');
    Route::get('criterios_evaluacion', 'CriterioEvaluacionController@index')->name('criterios');
    Route::get('reporte_notas', 'AdministrativoController@reporte')->name('ver_reporte');
});

Route::group(['prefix' => 'Docente','middleware' => 'docente'], function (){
    Route::get('home', 'DocenteController@index')->name('home_docente');
    Route::get('inscripcion_proyecto_titulo', 'IntegranteController@index')->name('inscribir_proyecto');
    Route::post('inscripcion_proyecto_titulo/agregar','IntegranteController@store')->name('add_inscripcion');
    Route::get('lista_proyectos_titulo', 'IntegranteController@show_proyect_docente')->name('lista_proyecto');
    Route::post('evaluacion_proyecto_titulo','EvaluacionProyectoController@store')->name('evaluar_proyecto');
    Route::post('evaluacion_proyecto_titulo/edit','EvaluacionProyectoController@edit')->name('editar_evaluacion_proyecto');
    Route::post('evaluacion_proyecto_titulo/delete','EvaluacionProyectoController@destroy')->name('eliminar_proyecto');
    Route::get('seccionPorCarrera/{id}', 'SeccionController@seccion_Carrera');
    Route::get('alumnoPorSeccion/{id}', 'AlumnoController@seccion_Alumno');
    Route::get('lista_proyectos_titulo/descargar/{file}','ProyectoTituloController@download_informe')->name('download');
    Route::get('inscripcion_defensa_tesis', 'DefensaTituloController@index')->name('inscribir_defensa');
    Route::post('inscripcion_defensa_tesis/agregar','DefensaTituloController@store')->name('add_defensa');
    Route::get('evaluacion_defensa', 'EvaluacionDefensaController@index')->name('evaluar_defensa');
    Route::get('comenzar_evaluacion/{id_alumno}', 'EvaluacionDefensaController@cargar_evaluacion');
    Route::get('cargar_alumnos/{id_alumno}', 'DefensaTituloController@cargar_alumnos');
    Route::post('guardar_evaluacion','EvaluacionDefensaController@store')->name('evaluacion_defensa');
    Route::get('lista_defensas_titulo','DefensaTituloController@edit_defensa')->name('lista_defensa');
    Route::post('lista_defensas_titulo/delete','DefensaTituloController@destroy')->name('eliminar_defensa');
    Route::get('reporte_notas', 'DocenteController@reporte')->name('reporte_docente');
});

Route::group(['prefix' => 'Alumno','middleware' => 'alumno'], function (){
    Route::get('home', 'AlumnoController@index')->name('home_alumno');
    Route::get('proyecto_titulo', 'ProyectoTituloController@index')->name('proyecto_titulo');
    Route::post('proyecto_titulo/modificar','ProyectoTituloController@edit')->name('edit_proyecto');
    Route::get('proyecto_titulo/descargar/{file}','ProyectoTituloController@download_informe')->name('download_informe');
    Route::get('reportes', 'AlumnoController@reporte')->name('reporte');
});
