@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Vista general</h2>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box bg-green hover-expand-effect" data-toggle="modal" data-target="#veractivos">
                        <div class="icon">
                            <i class="material-icons">flight_takeoff</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo a cargo</div>
                            <div class="number">{{ $count_proyectos }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-amber">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo a revisar</div>
                            <div class="number">{{ $count_proyectos_review }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!--<div class="row">
                <div class="col-md-12">
                    <div class="info-box bg-blue-grey hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">flight_takeoff</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensa de titulo más cercana</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect" data-toggle="modal" data-target="#verinvitacion">
                        <div class="icon bg-blue-grey">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensas de titulo invitadas</div>
                            <div class="number">
                                {{ $invitaciones }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inscribir_proyecto') }}" class="btn btn-block btn-lg bg-red waves-effect">Inscribir proyecto de titulo</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('lista_proyecto') }}" class="btn btn-block btn-lg bg-red waves-effect">Gestion proyecto de titulo</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inscribir_defensa') }}" class="btn btn-block btn-lg bg-red waves-effect">Inscribir defensa de titulo</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('evaluar_defensa') }}" class="btn btn-block btn-lg bg-red waves-effect">Evaluar defensa de titulo</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="veractivos" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Lista de proyectos a cargo como Docente guía</h4>
                </div>
                <div class="modal-body">
                      <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead style="background: #bd1414;">
                            <th style="color: white;">Nombre proyecto</th>
                            <th style="color: white;">Integrantes</th>
                        </thead>
                        <tbody>
                              @foreach($list_proyectos as $detalle)
                                <tr>
                                    <td>{{ $detalle->nombre_proyecto }}</td>
                                    <td>{{ $detalle->integrantes }}</td>
                                </tr>
                              @endforeach
                        </tbody>
                      </table>
                      
                </div>
                <div class="modal-footer">
                    <a href="{{ route('lista_proyecto') }}" class="btn bg-red">Acceder a gestión</a>
                    <input type="button" class="btn" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>


    <div id="verinvitacion" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Lista de invitaciones a proyectos de tesis</h4>
                </div>
                <div class="modal-body">
                      <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead style="background: #bd1414;">
                            <th style="color: white;">Nombre proyecto</th>
                            <th style="color: white;">Fecha</th>
                            <th style="color: white;">Hora</th>
                            <th style="color: white;">Sala</th>
                        </thead>
                        <tbody>
                              @foreach($lista_invitaciones as $inv)
                                <tr>
                                    <td>{{ $inv->nombre }}</td>
                                    <td>{{ $inv->fecha }}</td>
                                    <td>{{ $inv->hora }}</td>
                                    <td>{{ $inv->sala }}</td>
                                </tr>
                              @endforeach
                        </tbody>
                      </table>
                      
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>
    </div>
        
@endsection