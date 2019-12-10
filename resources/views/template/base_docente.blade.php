<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Proyecto</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href={{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/node-waves/waves.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/animate-css/animate.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}>
    <link rel="stylesheet" href={{ URL::asset('css/style.css') }}>
    <link rel="stylesheet" href={{ URL::asset('css/themes/all-themes.css') }}>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <div class="overlay"></div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../../index.html">"S.E.P.T."</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('logout') }}" class="dropdown-toggle" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="material-icons">input</i> Cerrar sesión</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                    </form>
                </ul>
                        
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nombre." ".Auth::user()->apellido }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li>
                        <a href="{{ route('home_docente') }}">
                            <i class="material-icons">home</i>
                            <span>Vista general</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle waves-effect waves-block toggled">
                            <i class="material-icons">home</i>
                            <span>Proyectos de titulo</span>
                        </a>
                        <ul class="ml-menu" style="display: block;">
                            <li>
                                <a href="{{ route('inscribir_proyecto') }}" class=" waves-effect waves-block">Inscribir proyecto</a>
                            </li>
                            <li>
                                <a href="{{ route('lista_proyecto') }}" class=" waves-effect waves-block">Gestion de proyecto</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle waves-effect waves-block toggled">
                            <i class="material-icons">home</i>
                            <span>Defensas de titulo</span>
                        </a>
                        <ul class="ml-menu" style="display: block;">
                            <li>
                                <a href="{{ route('inscribir_defensa') }}" class=" waves-effect waves-block">Inscribir defensa</a>
                            </li>
                            <li>
                                <a href="{{ route('lista_defensa') }}" class=" waves-effect waves-block">Eliminar defensas</a>
                            </li>
                            <li>
                                <a href="{{ route('evaluar_defensa') }}" class=" waves-effect waves-block">Evaluar defensa</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('reporte_docente') }}">
                            <i class="material-icons">home</i>
                            <span>Reporte notas</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">Nombre plataforma</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    <section class="content">
        @yield('content')
    </section>


<script src={{ URL::asset("plugins/jquery/jquery.min.js")}}></script>
<script src={{ URL::asset("plugins/bootstrap/js/bootstrap.js")}}></script>
@yield('script_select')  
<!--<script src={{ URL::asset("plugins/bootstrap-select/js/bootstrap-select.js")}}></script>-->
<script src={{ URL::asset("plugins/jquery-slimscroll/jquery.slimscroll.js")}}></script>
<script src={{ URL::asset("plugins/node-waves/waves.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/jquery.dataTables.js")}}></script>

<script src={{ URL::asset("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")}}></script>

<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/buttons.flash.min.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/pdfmake.min.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/vfs_fonts.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/buttons.html5.min.js")}}></script>
<script src={{ URL::asset("plugins/jquery-datatable/extensions/export/buttons.print.min.js")}}></script>
<script src={{ URL::asset("js/admin.js")}}></script>
<script src={{ URL::asset("js/pages/ui/modals.js")}}></script>
<script src={{ URL::asset("js/pages/tables/jquery-datatable.js")}}></script>
<script src={{ URL::asset("js/demo.js")}}></script>
@yield('script')  
    </body>
</html>
