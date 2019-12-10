@extends('template.base_admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Vista general</h2>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box-2 bg-indigo hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">email</i>
                        </div>
                        <div class="content">
                            <div class="text">Alumnos totales</div>
                            <div class="number">{{ $count_alumnos }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box-2 bg-red hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">devices</i>
                        </div>
                        <div class="content">
                            <div class="text">Docentes totales</div>
                            <div class="number">{{ $count_docentes }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box-2 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">devices</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo inscritos</div>
                            <div class="number">{{ $count_total_proyecto }}</div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo aprobados</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo en revisión</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Proyectos de titulo rechazados</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div> -->
            
        </div>
        <!--<div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box-2 bg-brown hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">devices</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensas de titulo agendadas</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-brown">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensas de titulo aprobadas</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-brown">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Defensas de titulo en rechazadas</div>
                            <div class="number">-</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>
        
@endsection