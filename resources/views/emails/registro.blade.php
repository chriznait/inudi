<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de matricula</title>
</head>
<body>
    <h1>Registro de matricula</h1>
    <p>Estimado(a) {{ $persona->nombre}} {{ $persona->apellido }}</p>
    <p>Se ha registrado su matricula con el siguiente detalle:</p>
    <ul>
        <li>Nombre: {{ $persona->nombre}} {{ $persona->apellido }}</li>
        <li>Correo: {{ $persona->email }}</li>
        <li>Telefono: {{ $persona->telefono }}</li>
        <li>Curso: {{ $curso->nombreCurso }}</li>
    </ul>
    <h3>Enlace del grupo whassap</h3>
    <a href="{{$curso->linkGrupo}}">
        {{$curso->linkGrupo}}
    </a>
    <h3>Link de la plataforma</h3>
    <a href="">Plataforma</a>
    
    <p>Saludos cordiales</p>
    
    
   
</body>
</html>
