@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Inscripción de defensa de título</h2>
    </div>

    <!--============================================================ MENSAJES DE ACCION ============================== -->
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
    <!-- =================================================================================================== -->

    <div class="row">
        <center><label>Complete los siguientes parametros para abrir el formulario de inscripción para defensa de titulo (basta con solo un alumno para cargar el equipo completo)</label></center><br>
        <div class="col-md-12">
            <form  id="eval">
            <div class="row clearfix">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select id="carrera" class="form-control">
                                <option value="">-- Seleccionar Carrera --</option>
                                @foreach($carrera as $d)
                                    <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select id="seccion" class="form-control">
                                <option value="">-- Seleccionar Seccion --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control" id="alumno_muestra" required>
                                <option value="">-- Seleccionar Alumno --</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" class="btn bg-green waves-effect" onsubmit="guardar(e); return false;">
                    <i class="material-icons">open_in_new</i>
                    <span>Cargar formulario</span>
                </button>
            </center>
            </form>
        </div>
    </div>

    <br/><br/>

    <div class="row" style="display: none" id="inscripcion">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Formulario para inscribir una defensa de título
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('add_defensa') }}" method="POST">@csrf
                        <div class="row clearfix">
                            <div class="col-md-4">
                               <strong>Alumno 1</strong><br>
                               <span id="id_alumno1"></span>
                               <input type="hidden" name="alumno1" id="alumno1">
                               <input type="hidden" name="email1" id="email1">
                            </div>
                            <div class="col-md-4">
                               <strong>Alumno 2</strong><br>
                               <span id="id_alumno2"></span>
                               <input type="hidden" name="alumno2" id="alumno2">
                               <input type="hidden" name="email2" id="email2">
                            </div>
                            <div class="col-md-4">
                               <strong>Alumno 3</strong><br>
                               <span id="id_alumno3"></span>
                               <input type="hidden" name="alumno3" id="alumno3">
                               <input type="hidden" name="email3" id="email3">
                            </div>
                        </div><br><br>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">Sala de clases</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                        <input type="number" name="sala" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">Fecha</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                        <input type="date" name="fecha" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">Horario</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                		<input type="time" name="horario" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="card-inside-title">Docente invitado 1</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                        <select name="docente_inv1" id="docente1" class="form-control" onchange="verify(this)" required>
                                            <option value="">-- Seleccionar --</option>
                                             @foreach($list_docente as $d)
                                                <option value="{{ $d->id }}">{{ $d->nombre." ".$d->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <h2 class="card-inside-title">Docente invitado 2</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                        <select name="docente_inv2" id="docente2" class="form-control" onchange="verify(this)" required>
                                            <option value="">-- Seleccionar --</option>
                                             @foreach($list_docente as $d)
                                                <option value="{{ $d->id }}">{{ $d->nombre." ".$d->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="card-inside-title">Observación</h2>
                                <div class="form-group">
                                	<div class="form-line">
                                        <textarea rows="3" cols="1" name="observacion" class="form-control no-resize" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_proyecto" id="id_proyecto">
                        <br>
                        <center><button type="submit" class="btn bg-red m-t-15 waves-effect" >Inscribir</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_select')
<script type="text/javascript">
        //=============== ALUMNO 1 ======================
        $("#carrera").change(function(){
            var carrera = $(this).val();
            $.get('seccionPorCarrera/'+carrera, function(data){
                $('#seccion').empty();
                $('#seccion').append("<option focus value=''>-- Seleccionar Seccion --</option>");
                $.each(data, function(index, value){
                    $('#seccion').append("<option value='"+index+"'>"+value+"</option>");
                })
            });
        });

        $("#seccion").change(function(){
            var seccion = $(this).val();
            $.get('alumnoPorSeccion/'+seccion, function(data2){
                $('#alumno_muestra').empty();
                $('#alumno_muestra').append("<option focus value=''>-- Seleccionar Alumno --</option>");
                $.each(data2, function(index, value){
                    $('#alumno_muestra').append("<option value='"+index+"'>"+value+"</option>");
                })
            }).fail(function() {
                alert('Error! No hay alumnos disponibles para esta sección');
                $('#alumno_muestra').empty();
                $('#alumno_muestra').append("<option focus value=''>-- Seleccionar Alumno --</option>");
            });
        });

        function verify(s1) {
            var s2;
            for (var i=1;i<=2;i++) {
                s2 = document.getElementById('docente' + i);
                if (s1.value == s2.value && s1 != s2) {
                    alert('Error! Por favor, ingrese otro docente y no el mismo que el anterior');
                    s1.options[0].selected = true;
                    return;
                }
            }
        }


        $("#eval").on("submit", function(e) {
            e.preventDefault();
            var id_alumno = document.getElementById("alumno_muestra").value;
            //console.log(id_alumno);
            $.get('cargar_alumnos/'+id_alumno, 
                function(data){
                    document.getElementById('inscripcion').style.display = 'block';
                    //console.log(data[0]['integrantes']);
                    //console.log(data[0]['id_integrantes']);
                    var integrante = data[0]['integrantes'].split(", ");
                    var id_integrante = data[0]['id_integrantes'].split(", ");
                    var email_integrante = data[0]['email'].split(", ");
                    //console.log(integrante.length);
                    document.getElementById('id_alumno1').innerHTML = integrante[0];
                    $('#alumno1').val(id_integrante[0]);
                    $('#id_proyecto').val(data[0]['proyecto_id']);
                    $('#email1').val(email_integrante[0]);
                    if (integrante.length == 2) {
                        document.getElementById('id_alumno2').innerHTML = integrante[1];
                        $('#alumno2').val(id_integrante[1]);
                        $('#email2').val(email_integrante[1]);
                    }
                    else if (integrante.length == 3) {
                       document.getElementById('id_alumno3').innerHTML = integrante[2];
                       $('#alumno3').val(id_integrante[2]);
                       $('#email3').val(email_integrante[2]);
                    }
                    else{ }
                 $("#agregar").modal("hide");
            }).fail(function() {
                alert('No hay proyectos de titulo para este integrante');
            });
        });
</script>

@endsection