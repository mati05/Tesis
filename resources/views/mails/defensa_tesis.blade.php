<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Defensa de Tesis</title>
</head>
<body>
    <p>Hola! {{$nombre}} Se ha fijado la fecha {{ $fecha }} para su la defensa del proyecto {{ $proyecto}}.</p>
    <p>La hora y sala se presenta a continuacion:</p>
    <ul>
        <li>Sala: {{ $sala }}</li>
        <li>Hora: {{ $horario }}</li>
    </ul>
    <p>Recordar ser puntual.</p>
    <p>Atentamente Profesor Guía {{$profesor_guia}}.</p>
</body>
</html>
