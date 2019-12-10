@extends('template.base_alumno')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Generación reporte de notas</h2>
    </div>

    <br>

    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-primary">
                <div class="panel-heading">Detalle notas por Item</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table js-exportable">
                            <thead>
                                <tr>
                                    <th>Nombre docente evaluador</th>
                                    <th>Nota Item Exposición</th>
                                    <th>Nota Item Demostración</th>
                                    <th>Nota Item Personal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalle as $u)
                                    <tr>
                                        <td>{{ $u->user_docente_id }}</td>
                                        <td>{{ $u->evaluacion1  }}</td>
                                        <td>{{ $u->evaluacion2  }}</td>
                                        <td>{{ $u->evaluacion3  }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Notas finales por docente</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table js-exportable">
                            <thead>
                                <tr>
                                    <th>Nombre docente evaluador</th>
                                    <th>Nota final</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unitaria as $u)
                                    <tr>
                                        <td>{{ $u->user_docente_id }}</td>
                                        <td>{{ $u->nota }}</td>
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
        
@endsection