<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sin Autorización</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href={{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/node-waves/waves.css') }}>
    <link rel="stylesheet" href={{ URL::asset('css/style.css') }}>
</head>

<body class="five-zero-zero">
    <div class="five-zero-zero-container">
        <div class="error-code">401</div>
        <div class="error-message">Usuario no autorizado</div>
        <div class="button-place">
            <a href="/" class="btn btn-default btn-lg waves-effect">Volver</a>
        </div>
    </div>

    <script src={{ URL::asset("plugins/jquery/jquery.min.js")}}></script>
    <script src={{ URL::asset("plugins/bootstrap/js/bootstrap.js")}}></script>
    <script src={{ URL::asset("plugins/node-waves/waves.js")}}></script>
</body>

</html>