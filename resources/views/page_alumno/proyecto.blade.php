@extends('template.base_alumno')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Gestion Proyecto título</h2>
    </div>

    <!--============================================================ MENSAJES DE ACCION ================================================== -->
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
    <!-- ================================================================================================================================== -->

    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Formulario para proyecto de titulo
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('edit_proyecto') }}" method="POST" files="true" enctype="multipart/form-data">@csrf
                        @foreach($detalle_proyecto as $d)
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label for="email_address">Nombre proyecto</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nombre_proyecto" id="idproyecto" value="{{ $d->nombre }}" class="form-control" required>
                                    </div>
                                </div>
                                   <!-- <input type="checkbox" id="checkbox" name="nombre_proyecto2" class="filled-in chk-col-red">
                                        <label for="checkbox">Pendiente</label>-->
                            </div>
                            <div class="col-sm-3">
                                <label for="password">Docente Guía</label>
                                <div class="form-group">
                                    <strong>{{ $d->nombre_docente." ".$d->apellido_docente }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <label for="password">Observación</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="3" cols="1" name="observacion" class="form-control no-resize">{{ $d->observaciones }}</textarea required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label for="password">Archivo proyecto actual</label>
                                <div class="form-group">
                                    <?php if ($d->ruta_archivo == '-') { ?>
                                        <center><h4>Aún no existe archivo</h4></center>
                                    <?php } else { ?>
                                        <span>{{ $d->nombre_archivo }} </span>
                                            <a href="{{ route('download_informe',$d->id) }}" class="btn btn-success btn-sm">
                                                <i class="material-icons">file_download</i>
                                                <span>Descargar</span>
                                            </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="password">Nuevo Archivo proyecto</label><small> (Solo pdf)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="archivo" class="form-control" accept="application/pdf">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_proyecto" value="{{ $d->id }}">
                        </div>
                        
                        <br>
                        <center><button type="submit" class="btn bg-red m-t-15 waves-effect">Guardar</button></center>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection

@section('script')
<script type="text/javascript">
    $('input[type=checkbox]').on('change', function() {
        if ($(this).is(':checked') ) {
            document.getElementById('idproyecto').disabled = true;
        } else {
            document.getElementById('idproyecto').disabled = false;
        }
    });
</script>
@endsection