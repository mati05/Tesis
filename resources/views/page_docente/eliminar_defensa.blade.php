@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Eliminación de defensa de titulo</h2>
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

    <br> 

    <div class="row">
    	<div class="col-md-12">
    		<div class="card">
                <div class="header">
                    <h2>Lista de defensas inscritos</h2>
                </div>
    			<div class="body">
                  
                    <div class="table-responsive">
                        <table id="tabla_proyecto" class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="display: none">id</th>
                                    <th>Nombre Proyecto</th>
                                    <th>Carrera</th>
                                    <th>Seccion</th>
                                    <th>Integrantes</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lista as $detalle)
                                    <tr>
                                        <td style="display: none">{{ $detalle->proyecto_id }}</td>
                                        <td>{{ $detalle->nombre_proyecto }}</td>
                                        <td>{{ $detalle->carrera }}</td>
                                        <td>{{ $detalle->seccion }}</td>
                                        <td>{{ $detalle->integrantes }}</td>
                                        <td>
                                            <center>
                                                <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#delete_inscripcion">
                                                    <i class="material-icons">delete</i>
                                                    <span>Eliminar</span>
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



<!--========================================== ELIMINAR ================================================ -->
            <div class="modal fade" id="delete_inscripcion" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-red">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                        </div>
                        <form action="{{ route('eliminar_defensa') }}" method="POST">@csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_eliminar" id="id_eliminar">
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

@section('script')
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
  });

});
</script>
@endsection