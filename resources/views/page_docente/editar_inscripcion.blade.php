@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Gestion de proyectos de título</h2>
    </div>

    <!--============================================================ MENSAJES DE ACCION ======================================= -->
        @if (Session::has('message'))
          @if(strcmp(Session::get('tipe_message'), 'danger'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ Session::get('message') }}</strong>
            </div>
          @else
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ Session::get('message') }}</strong>
            </div>
          @endif
        @endif
<!-- =========================================================================================================================== -->

    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a href="{{ route('inscribir_proyecto') }}" class="btn btn-block btn-lg bg-red waves-effect">Inscribir proyecto</a>
        </div>
    </div>
    
    <br><br>
    

    <div class="row">
    	<div class="col-md-12">
    		<div class="card">
                <div class="header">
                    <h2>Lista de proyectos inscritos</h2>
                </div>
    			<div class="body">
                  
                    <div class="table-responsive">
                        <table id="tabla_proyecto" class="table table-bordered table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th style="display: none">id</th>
                                    <th>Nombre Proyecto</th>
                                    <th>Carrera</th>
                                    <th>Seccion</th>
                                    <th>Integrantes</th>
                                    <th>Nota</th>
                                    <th style="display: none"></th>
                                    <th style="display: none"></th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_proyectos as $detalle)
                                    <tr>
                                        <td style="display: none">{{ $detalle->proyecto_id }}</td>
                                        <td>{{ $detalle->nombre_proyecto }}</td>
                                        <td>{{ $detalle->carrera }}</td>
                                        <td>{{ $detalle->seccion }}</td>
                                        <td>{{ $detalle->integrantes }}</td>
                                        <td>{{ $detalle->nota }}</td>
                                        <td style="display: none">{{ $detalle->observacion }}</td>
                                        <td style="display: none">{{ $detalle->id_eval }}</td>
                                        <td>
                                            <center>
                                                <button type="button" class="btn bg-green waves-effect" data-toggle="modal" data-target="#opciones">
                                                    <i class="material-icons">open_in_new</i>
                                                    <span>Ver opciones</span>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
</div>



<!--========================================== OPCIONES DE ACCION ================================================ -->
            <div class="modal fade" id="opciones" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Selecciona una opción para el proyecto</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_proyecto">
                            <center>
                            <button type="button" class="btn bg-indigo waves-effect" data-toggle="modal" data-target="#evaluar">
                                <i class="material-icons">assignment</i>
                                <span>Evaluar</span>
                            </button>
                            <button type="button" class="btn bg-orange waves-effect" data-toggle="modal" data-target="#modificar">
                                <i class="material-icons">create</i>
                                <span>Modificar</span>
                            </button>
                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#delete_inscripcion">
                                <i class="material-icons">delete</i>
                                <span>Eliminar</span>
                            </button>
                            <a href="#" class="btn btn-success btn-sm" onclick="descargar();">
                                <i class="material-icons">file_download</i>
                                <span>Descargar archivo proyecto</span>
                            </a>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

<!-- ================================================= EVALUAR  ===================================================== -->
            <div class="modal fade" id="evaluar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Evaluar proyecto</h4>
                        </div>
                        <form action="{{ route('evaluar_proyecto') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label>Nombre de proyecto</label>
                                    </div>
                                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="nombre_proyecto" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-6 form-control-label">
                                        <label>Nota del proyecto</label>
                                    </div>
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" step="any" min="1" name="nota" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label>Observación</label>
                                    </div>
                                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="3" cols="1" name="observacion" class="form-control no-resize" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_evaluar" id="id_evaluar" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect">Guardar evaluación</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


<!-- ================================================= Modificar  ===================================================== -->
            <div class="modal fade" id="modificar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar proyecto</h4>
                        </div>
                        <form action="{{ route('editar_evaluacion_proyecto') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label>Nombre de proyecto</label>
                                    </div>
                                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nombre_proyecto" id="nombre_proyecto_edit" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-6 form-control-label">
                                        <label>Nota del proyecto</label>
                                    </div>
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nota" id="nota_edit" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label>Observación</label>
                                    </div>
                                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="3" cols="1" name="observacion" id="observacion" class="form-control no-resize"></textarea required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_eval" id="id_eval" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect">Modificar</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>




<!--========================================== ELIMINAR ================================================ -->
            <div class="modal fade" id="delete_inscripcion" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-red">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                        </div>
                        <form action="{{ route('eliminar_proyecto') }}" method="POST">@csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_eliminar" id="id_eliminar"> 
                                <input type="hidden" name="id_eval_eliminar" id="id_eval_eliminar"> 
                                <span>¿Está seguro de eliminar este registro?</span>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-link waves-effect">Confirmar</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
@endsection

@section('script_select')
<script type="text/javascript">
$(document).ready(function() {
    $('#tabla_proyecto tbody').on('click', 'tr', function () {
      var id = $(this).closest("tr").find('td:eq(0)').text();
      var proyecto = $(this).closest("tr").find('td:eq(1)').text();
      var carrera = $(this).closest("tr").find('td:eq(2)').text();
      var seccion = $(this).closest("tr").find('td:eq(3)').text();
      var integrantes = $(this).closest("tr").find('td:eq(4)').text();
      var nota = $(this).closest("tr").find('td:eq(5)').text();
      var observacion = $(this).closest("tr").find('td:eq(6)').text();
      var id_eval = $(this).closest("tr").find('td:eq(7)').text();
      $('#id_eliminar').val(id); //id_proyecto
      $('#id_proyecto').val(id);
      $('#id_evaluar').val(id);
      $('#nombre_proyecto').val(proyecto);
      $('#nombre_proyecto_edit').val(proyecto);
      $('#nota_edit').val(nota);
      $('#observacion').val(observacion);
      $('#id_eval').val(id_eval);
      $('#id_eval_eliminar').val(id_eval);
  });

});

function descargar() {
        var id = document.getElementById('id_proyecto').value; // change here
        console.log(id);
        window.location.href = "lista_proyectos_titulo/descargar/"+id;
    }
</script>
@endsection