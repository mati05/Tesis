@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Inscripción Proyecto título</h2>
    </div>

    <!--============================================================ MENSAJES DE ACCION ============================================ -->
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
    <!-- ========================================================================================================================= -->

    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Formulario para inscribir un proyecto de título
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('add_inscripcion') }}" method="POST">@csrf
                        <div class="row clearfix">
                            <div class="col-md-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label>Nombre de proyecto</label>
                            </div>
                            <div class="col-md-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-4 col-sm-2 col-xs-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="checkbox" id="checkbox" name="nombre_proyecto2" class="filled-in chk-col-red">
                                        <label for="checkbox">Pendiente</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <select class="form-control" id="alumno1" onchange="verify(this)" name="alumno1" required>
                                            <option value="">-- Seleccionar Alumno --</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="button" class="btn bg-red btn-xs waves-effect" onclick="agregar_otro()">
                                        <i class="material-icons">add</i>
                                        <span>Agregar otro integrante</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="button" class="btn bg-blue-grey btn-xs waves-effect" style="display: none" onclick="eliminar_otro()" id="no_agregar">
                                        <i class="material-icons">clear</i>
                                        <span>No agregar otro integrante</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        

                        <div class="row clearfix" id="alumno_2" style="display: none">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="carrera2" class="form-control">
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
                                        <select id="seccion2" class="form-control">
                                            <option value="">-- Seleccionar Sección --</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="alumno2" onchange="verify(this)" name="alumno2">
                                    <option value="">-- Seleccionar Alumno --</option>
                                    
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="button" class="btn bg-red btn-xs waves-effect" id="agregar2" onclick="agregar_otro2()" style="display: none">
                                        <i class="material-icons">add</i>
                                        <span>Agregar otro integrante</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="button" class="btn bg-blue-grey btn-xs waves-effect" style="display: none" onclick="eliminar_otro2()" id="no_agregar2">
                                        <i class="material-icons">clear</i>
                                        <span>No agregar otro integrante</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                         

                        <div class="row clearfix" id="alumno_3" style="display: none">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="carrera3" class="form-control">
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
                                        <select id="seccion3" class="form-control">
                                            <option value="">-- Seleccionar Sección --</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="alumno3" onchange="verify(this)" name="alumno3">
                                    <option value="">-- Seleccionar Alumno --</option>
                                    
                                </select>
                            </div>
                        </div>

                        <br>
                        <center><button type="submit" class="btn bg-red m-t-15 waves-effect">Inscribir</button></center>
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
                $('#alumno1').empty();
                $('#alumno1').append("<option focus value=''>-- Seleccionar Alumno --</option>");
                $.each(data2, function(index, value){
                    $('#alumno1').append("<option value='"+index+"'>"+value+"</option>");
                })
            }).fail(function() {
                alert('Error! No hay alumnos disponibles para esta sección');
                $('#alumno1').empty();
                $('#alumno1').append("<option focus value=''>-- Seleccionar Alumno --</option>");
            });
        });

        //=============== ALUMNO 2 ======================
        $("#carrera2").change(function(){
            var carrera2 = $(this).val();
            $.get('seccionPorCarrera/'+carrera2, function(data){
                $('#seccion2').empty();
                $('#seccion2').append("<option focus value=''>-- Seleccionar Seccion --</option>");
                $.each(data, function(index, value){
                    $('#seccion2').append("<option value='"+index+"'>"+value+"</option>");
                })
            });
        });

        $("#seccion2").change(function(){
            var seccion2 = $(this).val();
            $.get('alumnoPorSeccion/'+seccion2, function(data2){
                $('#alumno2').empty();
                $('#alumno2').append("<option focus value=''>-- Seleccionar Alumno --</option>");
                $.each(data2, function(index, value){
                    $('#alumno2').append("<option value='"+index+"'>"+value+"</option>");
                })
            }).fail(function() {
                alert('Error! No hay alumnos disponibles para esta sección');
                $('#alumno2').empty();
                $('#alumno2').append("<option focus value=''>-- Seleccionar Alumno --</option>");
            });
        });

        //=============== ALUMNO 3 ======================
        $("#carrera3").change(function(){
            var carrera3 = $(this).val();
            $.get('seccionPorCarrera/'+carrera3, function(data){
                $('#seccion3').empty();
                $('#seccion3').append("<option focus value=''>-- Seleccionar Seccion --</option>");
                $.each(data, function(index, value){
                    $('#seccion3').append("<option value='"+index+"'>"+value+"</option>");
                })
            });
        });

        $("#seccion3").change(function(){
            var seccion3 = $(this).val();
            $.get('alumnoPorSeccion/'+seccion3, function(data2){
                $('#alumno3').empty();
                $('#alumno3').append("<option focus value=''>-- Seleccionar Alumno --</option>");
                $.each(data2, function(index, value){
                    $('#alumno3').append("<option value='"+index+"'>"+value+"</option>");
                })
            }).fail(function() {
                alert('Error! No hay alumnos disponibles para esta sección');
                $('#alumno3').empty();
                $('#alumno3').append("<option focus value=''>-- Seleccionar Alumno --</option>");
            });
        });
</script>
@endsection

@section('script')
<script type="text/javascript">
    function agregar_otro(){
        document.getElementById('alumno_2').style.display = 'block';
        document.getElementById('agregar2').style.display = 'block';
        document.getElementById('no_agregar').style.display = 'block';
        document.getElementById('alumno2').required = true;
    }

    function eliminar_otro(){
        document.getElementById('alumno_2').style.display = 'none';
        document.getElementById('agregar2').style.display = 'none';
        document.getElementById('no_agregar').style.display = 'none';
        document.getElementById('alumno2').required = false;
        eliminar_otro2();
    }

    function agregar_otro2(){
        document.getElementById('alumno_3').style.display = 'block';
        document.getElementById('no_agregar2').style.display = 'block';
        document.getElementById('alumno3').required = true;
    }

    function eliminar_otro2(){
        document.getElementById('alumno_3').style.display = 'none';
        document.getElementById('no_agregar2').style.display = 'none';
        document.getElementById('alumno3').required = false;
    }

   $('input[type=checkbox]').on('change', function() {
        if ($(this).is(':checked') ) {
            document.getElementById('nombre_proyecto').disabled = true;
        } else {
            document.getElementById('nombre_proyecto').disabled = false;
        }
    });

   function verify(s1) {
            var s2;
            for (var i=1;i<=3;i++) {
                s2 = document.getElementById('alumno' + i);
                if (s1.value == s2.value && s1 != s2) {
                    alert('Error! Por favor, ingrese otro alumno y no el mismo que el anterior');
                    s1.options[0].selected = true;
                    return;
                }
            }
        }
</script>
@endsection