@extends('template.base_admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Gestión de secciones</h2>
    </div>

    <!--============================================================ MENSAJES DE ACCION =============================================== -->
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
	<!-- ============================================================================================================================= -->

	<div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a href="" data-toggle="modal" data-target="#agregar" class="btn btn-block btn-lg bg-green waves-effect">Agregar sección</a>
        </div>
    </div>
    
    <br><br>

    <div class="row">
    	<div class="col-md-12">
    		<div class="card">
                <div class="header">
                    <h2>Lista de secciones</h2>
                </div>
    			<div class="body">
                    <div class="table-responsive">
                        <table id="tabla_seccion" class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="display: none">id</th>
                                    <th>Código sección</th>
                                    <th>Jornada</th>
                                    <th>Carrera</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($secciones as $seccion)
                                    <tr>
                                        <td style="display: none">{{ $seccion->id }}</td>
                                        <td>{{ $seccion->codigo_seccion }}</td>
                                        <td>{{ $seccion->jornada }}</td>
                                        <td>{{ $seccion->carrera }}</td>
                                        <td>
                                            <button type="button" class="btn bg-amber btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modificar">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete">
                                                <i class="material-icons">delete_sweep</i>
                                            </button>
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


<!-- ================================================= AGREGAR ===================================================== -->
    <div class="modal fade" id="agregar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Agregar Sección</h4>
                </div>
                <form action="{{ route('add_seccion') }}" method="POST">@csrf
	                <div class="modal-body">
	                    <div class="body">
	                        <div class="row clearfix">
	                        	<div class="col-sm-3"></div>
	                            <div class="col-sm-6">
	                                <div class="form-group">
	                                    <div class="form-line">
	                                        <select name="carrera" class="form-control">
	                                            <option value="">-- Seleccionar Carrera --</option>
	                                            @foreach($carrera as $d)
	                                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
	                                            @endforeach
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-sm-3"></div>
	                        </div><br>
	                        <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>Código de sección</b>
                                    <div class="form-group">
	                                    <div class="form-line">
	                                        <input type="text" name="codigo" class="form-control" required>
	                                    </div>
	                                </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Jornada</b>
                                    <select name="jornada" class="form-control">
                                        <option value="">-- Seleccionar Jornada --</option>
                                        <option value="Diurna">Diurna</option>
                                        <option value="Vespertina">Vespertina</option>
                                    </select>
                                </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="submit" class="btn btn-danger waves-effect">Agregar</button>
	                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
	                </div>
                </form>
            </div>
        </div>
    </div>


<!-- ================================================= MODIFICAR ===================================================== -->
    <div class="modal fade" id="modificar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Modificar Sección</h4>
                </div>
                <form action="{{ route('edit_seccion') }}" method="POST">@csrf
                <div class="modal-body">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <b>Código de sección</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="codigo" id="codigo" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Jornada</b>
                                <select id="jornada" name="jornada" class="form-control">
                                    <option value="">-- Seleccionar Jornada --</option>
                                    <option value="Diurna">Diurna</option>
                                    <option value="Vespertina">Vespertina</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id_seccion" id="id_editar">
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
    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-red">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                </div>
                <form action="{{ route('delete_seccion') }}" method="POST">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_seccion" id="id_eliminar">
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



</div>
        
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#tabla_seccion tbody').on('click', 'tr', function () {
      var id = $(this).closest("tr").find('td:eq(0)').text();
      var codigo = $(this).closest("tr").find('td:eq(1)').text();
      var jornada = $(this).closest("tr").find('td:eq(2)').text();
      $('#id_eliminar').val(id);
      $('#id_editar').val(id);
      $('#codigo').val(codigo);
      $('#jornada').val(jornada);
  });
});
</script>
@endsection