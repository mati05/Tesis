@extends('template.base_admin')
@section('content')
<div class="container-fluid">
    <br>

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

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Administración de usuarios
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">person</i> Administrativos
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">person</i> Docentes
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#messages_with_icon_title" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">person</i> Alumnos
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9"><h4>Lista de Administrativos</h4></div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add_admin">
                                                <i class="material-icons">add_box</i><span>Agregar nuevo Administrativo</span>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    @if ($list_admin->isEmpty())
                                        <center><div>No hay Administrativos registrados</div></center>
                                    @else
                                    <div class="table-responsive">
                                        <table id="tabla_admin" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">id</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>R.U.N</th>
                                                    <th>Email</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list_admin as $d)
                                                <tr>
                                                    <td style="display: none">{{ $d->id }}</td>
                                                    <td>{{ $d->nombre }}</td>
                                                    <td>{{ $d->apellido }}</td>
                                                    <td>{{ $d->run }}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>
                                                        <button type="button" class="btn bg-amber btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#edit_admin">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete_admin">
                                                            <i class="material-icons">delete_sweep</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9"><h4>Lista de Docentes</h4></div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#add_docente">
                                                <i class="material-icons">add_box</i><span>Agregar nuevo Docente</span>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    @if ($list_docente->isEmpty())
                                        <center><div>No hay Docentes registrados</div></center>
                                    @else
                                    <div class="table-responsive">
                                        <table id="tabla_docente" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">id</th>
                                                    <th style="width: 15%;">Nombre</th>
                                                    <th style="width: 15%;">Apellido</th>
                                                    <th style="width: 15%;">R.U.N</th>
                                                    <th style="width: 20%;">Email</th>
                                                    <th style="width: 12%;">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list_docente as $d)
                                                <tr>
                                                    <td style="display: none">{{ $d->id }}</td>
                                                    <td>{{ $d->nombre }}</td>
                                                    <td>{{ $d->apellido }}</td>
                                                    <td>{{ $d->run }}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>
                                                        <button type="button" class="btn bg-amber btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#edit_docente">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete_docente">
                                                            <i class="material-icons">delete_sweep</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9"><h4>Lista de Alumnos</h4></div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger waves-effect"  data-toggle="modal" data-target="#add_alumno">
                                                <i class="material-icons">add_box</i><span>Agregar nuevo Alumno</span>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    @if ($list_alumno->isEmpty())
                                        <center><div>No hay Alumnos registrados</div></center>
                                    @else
                                    <div class="table-responsive">
                                        <table id="tabla_alumno" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="display: none">id</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>R.U.N</th>
                                                    <th>Email</th>
                                                    <th>Carrera</th>
                                                    <th>Seccion</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list_alumno as $d)
                                                <tr>
                                                    <td style="display: none">{{ $d->id }}</td>
                                                    <td>{{ $d->nombre }}</td>
                                                    <td>{{ $d->apellido }}</td>
                                                    <td>{{ $d->run }}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>{{ $d->carrera }}</td>
                                                    <td>{{ $d->codigo_seccion }}</td>
                                                    <td>
                                                        <button type="button" class="btn bg-amber btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#edit_alumno">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete_alumno">
                                                            <i class="material-icons">delete_sweep</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

<!-- ================================================= MODAL AGREGAR ADMINISTRATIVO ========================================= -->
            <div class="modal fade" id="add_admin" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Administrativo</h4>
                        </div>
                        <form action="{{ route('add_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="nombre" class="form-control" required>
                                                <label class="form-label">Nombre</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="apellido" class="form-control" required>
                                                <label class="form-label">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="run" class="form-control" required>
                                                <label class="form-label">R.U.N</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" required>
                                                <label class="form-label">Correo Electrónico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" required>
                                                <label class="form-label">Contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="rol" value="1">
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

            <!-- ================================================= MODAL EDITAR ADMINISTRATIVO ========================================= -->
            <div class="modal fade" id="edit_admin" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar Administrativo</h4>
                        </div>
                        <form action="{{ route('edit_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <input type="hidden" name="id_editar" id="id_editar">
                                    <div class="col-sm-4">
                                        <label for="email_address">Nombre</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" id="nombre_admin" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">Apellido</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" name="apellido" id="apellido_admin" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">R.U.N</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" name="run" id="run_admin" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <label for="email_address">Correo Electrónico</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email"  class="form-control" name="email" id="email_admin" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning waves-effect">Modificar</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--========================================== ELIMINAR ADMINISTRADOR ================================================ -->
            <div class="modal fade" id="delete_admin" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-red">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                        </div>
                        <form action="{{ route('delete_usuario') }}" method="POST">@csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_eliminar" id="id_eliminar_admin">
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

            <!-- ================================================= MODAL AGREGAR DOCENTE ========================================= -->
            <div class="modal fade" id="add_docente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Docente</h4>
                        </div>
                        <form action="{{ route('add_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" required>
                                                <label class="form-label">Nombre</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="apellido" required>
                                                <label class="form-label">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="run" required>
                                                <label class="form-label">R.U.N</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="email" required>
                                                <label class="form-label">Correo Electrónico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" required>
                                                <label class="form-label">Contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="rol" value="2">
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

            <!-- ================================================= MODAL EDITAR DOCENTE ========================================= -->
            <div class="modal fade" id="edit_docente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar Docente</h4>
                        </div>
                        <form action="{{ route('edit_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <input type="hidden" name="id_editar" id="id_editar2">
                                    <div class="col-sm-4">
                                        <label for="email_address">Nombre</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" id="nombre_docente" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">Apellido</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" name="apellido" id="apellido_docente" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">R.U.N</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" name="run" id="run_docente" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <label for="email_address">Correo Electrónico</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email"  class="form-control" name="email" id="email_docente" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning waves-effect">Modificar</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--=================================================== ELIMINAR DOCENTE ======================================== -->
            <div class="modal fade" id="delete_docente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-red">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                        </div>
                        <form action="{{ route('delete_usuario') }}" method="POST">@csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_eliminar" id="id_eliminar_docente">
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

            <!-- ================================================= MODAL ALUMNO ========================================= -->
            <div class="modal fade" id="add_alumno" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Agregar Alumno</h4>
                        </div>
                        <form action="{{ route('add_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" required> 
                                                <label class="form-label">Nombre</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="apellido" required>
                                                <label class="form-label">Apellidos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="run" required>
                                                <label class="form-label">R.U.N</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="email" required>
                                                <label class="form-label">Correo Electrónico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" required>
                                                <label class="form-label">Contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-md-5">
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
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="seccion" name="seccion" class="form-control" required>
                                                    <option value="">-- Seleccionar Seccion --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="rol" value="3">
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

            <!-- ========================================= MODAL ELIMINAR ALUMNO= ==================================================== -->
            <div class="modal fade" id="delete_alumno" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-red">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Eliminación de registro</h4>
                        </div>
                        <form action="{{ route('delete_usuario') }}" method="POST">@csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_eliminar" id="id_eliminar_alumno">
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

            <!-- ================================================= MODAL MODIFICAR ALUMNO ========================================= -->
            <div class="modal fade" id="edit_alumno" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modificar Alumno</h4>
                        </div>
                        <form action="{{ route('edit_usuario') }}" method="POST">@csrf
                        <div class="modal-body">
                            <div class="body">
                                <div class="row clearfix">
                                    <input type="hidden" name="id_editar" id="id_editar3">
                                    <div class="col-sm-4">
                                        <label for="email_address">Nombre</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" id="nombre_alumno" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">Apellido</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" name="apellido" id="apellido_alumno" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">R.U.N</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="run" id="run_alumno" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="email_address">Correo Electrónico</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email"  class="form-control" name="email" id="email_alumno" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="email_address">Carrera actual</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <span id="carrera_actual"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">Seccion actual</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <span id="seccion_actual"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <center>
                                              <label>¿Desea modificar?</label><br>
                                              <input type="button" class="btn btn-primary" id="si" value="Si" onclick="habilitar()" />
                                              <input type="button" class="btn btn-primary" id="no" value="No" onclick="desabilitar()"/>
                                            </center>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label for="email_address">Nueva Carrera</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="carrera2" class="form-control" disabled>
                                                    <option value="">-- Seleccionar Carrera --</option>
                                                    @foreach($carrera as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email_address">Nueva Sección</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="seccion2" name="seccion" class="form-control" disabled>
                                                    <option value="">-- Seleccionar Sección --</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning waves-effect">Modificar</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('script')
<script type="text/javascript">

    $("#carrera").change(function(){
        var carrera = $(this).val();
        $.get('seccionPorCarreraAlumno/'+carrera, function(data){
            $('#seccion').empty();
            $('#seccion').append("<option focus value=''>-- Seleccionar Seccion --</option>");
            $.each(data, function(index, value){
                $('#seccion').append("<option value='"+index+"'>"+value+"</option>");
            })
        });
    });

    $("#carrera2").change(function(){
        var carrera2 = $(this).val();
        $.get('seccionPorCarreraAlumno/'+carrera2, function(data){
            $('#seccion2').empty();
            $('#seccion2').append("<option focus value=''>-- Seleccionar Seccion --</option>");
            $.each(data, function(index, value){
                $('#seccion2').append("<option value='"+index+"'>"+value+"</option>");
            })
        });
    });

    function habilitar(){
        document.getElementById('carrera2').disabled=false;
        document.getElementById('seccion2').disabled=false;
        document.getElementById('si').style.color = 'red';
    }

    function desabilitar(){
        document.getElementById('carrera2').disabled=true;
        document.getElementById('seccion2').disabled=true;
        document.getElementById('si').style.color = '';
    }
    function habilitar2(){
        
    }

    function desabilitar2(){
        
    }

$(document).ready(function() {
    $('#tabla_admin tbody').on('click', 'tr', function () {
      var id = $(this).closest("tr").find('td:eq(0)').text();
      var nombre = $(this).closest("tr").find('td:eq(1)').text();
      var apellido = $(this).closest("tr").find('td:eq(2)').text();
      var run = $(this).closest("tr").find('td:eq(3)').text();
      var email = $(this).closest("tr").find('td:eq(4)').text();
      $('#id_eliminar_admin').val(id);
      $('#id_editar').val(id);
      $('#run_admin').val(run);
      $('#nombre_admin').val(nombre);
      $('#apellido_admin').val(apellido);
      $('#email_admin').val(email);
  });

    $('#tabla_docente tbody').on('click', 'tr', function () {
      var id = $(this).closest("tr").find('td:eq(0)').text();
      var nombre = $(this).closest("tr").find('td:eq(1)').text();
      var apellido = $(this).closest("tr").find('td:eq(2)').text();
      var run = $(this).closest("tr").find('td:eq(3)').text();
      var email = $(this).closest("tr").find('td:eq(4)').text();
      $('#id_eliminar_docente').val(id);
      $('#id_editar2').val(id);
      $('#run_docente').val(run);
      $('#nombre_docente').val(nombre);
      $('#apellido_docente').val(apellido);
      $('#email_docente').val(email);
  });

    $('#tabla_alumno tbody').on('click', 'tr', function () {
      var id = $(this).closest("tr").find('td:eq(0)').text();
      var nombre = $(this).closest("tr").find('td:eq(1)').text();
      var apellido = $(this).closest("tr").find('td:eq(2)').text();
      var run = $(this).closest("tr").find('td:eq(3)').text();
      var email = $(this).closest("tr").find('td:eq(4)').text();
      var carrera = $(this).closest("tr").find('td:eq(5)').text();
      var seccion = $(this).closest("tr").find('td:eq(6)').text();
      $('#id_eliminar_alumno').val(id);
      $('#id_editar3').val(id);
      $('#run_alumno').val(run);
      $('#nombre_alumno').val(nombre);
      $('#apellido_alumno').val(apellido);
      $('#email_alumno').val(email);
      document.getElementById('carrera_actual').innerHTML = carrera;
      document.getElementById('seccion_actual').innerHTML = seccion;
      document.getElementById('carrera_actual').disabled=true;
      document.getElementById('seccion_actual').disabled=true;
  });
});
</script>
@endsection