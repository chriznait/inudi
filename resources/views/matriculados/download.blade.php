<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page{
            margin: 0cm 0cm;
            font-family: Arial, Helvetica, sans-serif;
        }
        .nombre{
            position: absolute;
            top: {{ $course->nomEjeY }}px;
            left: {{ $course->nomEjeX }}px;
            font-size: 24px;
            text-align: center;
            width: 860px;
            padding: 0px;
            font-weight: bold;
        }
        #validacion{
            position: absolute;
            top: {{ $course->notaEjeY }}px;
            left: {{ $course->notaEjeX }}px;
            font-size: 16px;
            text-align: center;
            width: 200px;
            padding: 0px;
            border: 1px solid black;
            font-weight: bold;
            background: white;
            
        }
        #nota{
            position: absolute;
            top: {{ $course->codigoEjeY }}px;
            left: {{ $course->codigoEjeX }}px;
            font-size: 17px;
            text-align: center;
            width: 150px;
            height: 30px;
            padding: 0px;
            border: 1px solid black;
            font-weight: bold;
            background: white;
            align-content: center;
            padding: 10px 0 0 0;
        }
    </style>
</head>
<body>
    @if($course->imgCertificado != null)
        <div>
        <img style="width: 100%;" src="{{ public_path('img/modCertificado/'.$course->imgCertificado) }}" alt=""> 
        </div>
    @endif

    <div class="nombre">
        {{ $persona->nombre }} {{ $persona->apellido }}
    </div>
    <div id="validacion">
        <span>Fuente de validación:</span>
        <a href="https://inudi.edu.pe">inudi.edu.pe</a>
        <div id="codigo">
            CÓDIGO: {{ $registered->codigoCertificado }}
        </div>
    </div>
    @if($registered->nota != null)
        <div id="nota">
                NOTA: {{$registered->nota }}
        </div>
    @endif
    
    
</body>
</html>