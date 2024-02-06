<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envio de Certificado</title>
</head>
<body>
    <h1>Registro de matricula</h1>
    <p>Estimado(a) {{ $persona->nombre}} {{ $persona->apellido }}</p>
    <p>Ha completado satisfactoriamente el curso por lo cual se le expide el siguiente certificado:</p>
    <ul>
        <li>Nombre: {{ $persona->nombre}} {{ $persona->apellido }}</li>
        <li>Curso: {{ $curso->nombreCurso }}</li>
    </ul>
    <p>Adjunto a este correo el certificado correspondiente al curso.</p>
    
    
    <p>Saludos cordiales</p>
    
    
   
</body>
</html>
