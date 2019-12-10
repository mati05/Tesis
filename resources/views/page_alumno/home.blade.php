@extends('template.base_alumno')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Vista general</h2>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box bg-amber hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">email</i>
                        </div>
                        <div class="content">
                            <div class="text">Estado del proyecto de titulo</div>
                            <div class="number">
                                <?php
                                    if (count($evaluado) == 1) { echo "Evaluado"; }
                                    elseif($status_proyecto > 0 && count($evaluado) == 0){ echo "Inscrito"; }
                                    elseif ($status_proyecto == 0) { echo "Sin proyecto"; }
                                    else{ echo "En revisión"; }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-blue-grey">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Nombre proyecto</div>
                            @if ($nombre_proyecto->isEmpty())
                                <center><strong>-</strong></center>
                            @else
                                <strong>
                                    @foreach($nombre_proyecto as $n) 
                                        "{{ $n->nombre  }}"
                                    @endforeach
                                </strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-blue-grey">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Nota final proyecto</div>
                            <div class="number">
                                @if ($evaluado->isEmpty())
                                    <center><strong>-</strong></center>
                                @else
                                    @foreach($evaluado as $ev) 
                                        "{{ $ev->nota  }}"
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">flight_takeoff</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensa de titulo</div>
                                @if ($fecha_tesis->isEmpty())
                                    <center><div><strong>-</strong></div></center>
                                @else
                                    @foreach($fecha_tesis as $f) 
                                       <small>Fecha: {{ $f->fecha }}</small><br> 
                                       <small> Hora: {{ $f->hora  }}</small> 
                                    @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">flight_takeoff</i>
                        </div>
                        <div class="content">
                            <div class="text">Profesor Guía</div>
                            <div class="number">
                            @if ($docente->isEmpty())
                                <center><strong>-</strong></center>
                            @else
                                @foreach($docente as $n) 
                                    "{{ $n->nombre." ".$n->apellido  }}"
                                @endforeach
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body bg-green">
                            <div class="font-bold m-b--35"><center>Alumnos integrantes<center></div>
                            <ul class="dashboard-stat-list">
                                 @if ($docente->isEmpty())
                                    <center><strong>-</strong></center>
                                @else
                                    <center>
                                        @foreach($integrantes as $i)
                                            <li> - {{ $i->nombre }}</li>
                                        @endforeach
                                    </center>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('proyecto_titulo') }}" class="btn btn-block btn-lg bg-red waves-effect">Agregar proyecto de título</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('reporte') }}" class="btn btn-block btn-lg bg-red waves-effect">Ver reportes</a>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection
