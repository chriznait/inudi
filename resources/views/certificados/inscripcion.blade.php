<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/inudi.css') }}">
        
        <!-- Scripts -->
        <script src="{{ asset('js/inudi.js') }}" defer></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    </head>
    <body class="">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">
                    <strong>PLATAFORMA DE CERTIFICACIONES DE CURSOS, DIPLOMAS, PUBLICACIONES Y OTROS</strong>
                </h1>
                <p class="text-center instituto">
                    <strong>INSTITUTO UNIVERSITARIO DE INVESTIGACIÓN CIENCIA Y TECNOLOGÍA INUDI PERÚ</strong>
                </p>
            </div>
        </section>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    @if($valor>=1) 
                        <div class="alert alert-success border-success shadow" role="alert">
                            <strong>
                                <h5 class="alert-heading text-center">USUARIO REGISTRADO</h5>
                                Bienvenido! {{$datos->nombre}} {{$datos->apellido}}
                            </strong>
                        </div>
                        <div class="alert alert-info border-info shadow">
                            <strong>
                                GRACIAS POR ELEGIRNOS NUEVAMENTE
                            </strong>
                        </div>
                    @elseif($valor==0 )
                        <div class="alert alert-danger border-danger shadow" role="alert">
                            <strong>
                                <h5 class="alert-heading text-center">USUARIO NO REGISTRADO</h5>
                                Estimado participante, para poder inscribirse al curso, debe de verificar su DNI.
                            </strong>
                        </div>
                    @endif
                </div>
                <div class="col-sm-8">
                    <div class="card border-success shadow">
                        <div class="card-header text-center">
                            <h4><strong>FICHA DE INSCRIPCION </h4> 
                            <h5><strong>{{$curso->nombreCurso}}</strong></h5>
                             
                        </div>
                        @if (session('success-registrado'))
                            <div class="alert alert-success">
                                <strong>{{session('success-registrado')}}</strong>
                            </div>
                        @elseif( $valor == 2)
                            <div class="alert alert-warning">
                                <strong>Estimado participante, su inscripcion esta en proceso de validacion, en breve se le enviara un correo con la confirmacion de su inscripcion</strong>
                            </div>
                        @elseif( $valor == 3)
                            <div class="alert alert-success">
                                <strong>
                                    Estimado participante, su inscripcion ha sido validada, revise su correo electronico con la cual se inscribio, se le ha enviado un correo con el link de acceso al curso.
                                    El link al grupo de whatsapp se le envio al correo electronico.
                                </strong>
                                <p>
                                    <strong>Nota: </strong>Si no encuentra el correo en su bandeja de entrada, revise en la bandeja de spam o correo no deseado.
                                </p>
                                <p>
                                    Estado de inscripcion: <strong class="text-success"
                                    >VALIDADO</strong>
                                </p>
                            </div>

                        @endif


                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($valor==0 || $valor==1)

                                @if ($valor=='1')
                                    <form class="row g-12" method="POST" action="{{ route('certificados.update', $datos)}}">
                                        @csrf
                                        @method('PUT')
                                @else
                                    <form class="row g-12" method="POST" action="{{ route('certificados.store')}}">
                                        @csrf
                                @endif
                                    <div class="alert alert-info" role="alert">
                                        <h5 class="alert-heading text-center">Datos personales</h5>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nroDocumento" class="col-sm-4 col-form-label text-end"><strong>DNI:</strong> </label>
                                        <div class="col-sm-8">
                                            <input type="text" {{($valor=='1')?'readonly':'readonly'}}
                                            class="form-control" name="nroDocumento" id="nroDocumento" placeholder="DNI" value="{{$datos->nroDocumento??''}}">
                                            <input type="hidden" name="idPersona" id="idPersona" value="{{$datos->id}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-sm-4 col-form-label text-end"><strong>Nombre</strong></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{$datos->nombre??old('nombre')}}"
                                            value = "{{old('nombre')}}"
                                            >
                                            @if ($errors->has('nombre'))
                                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                            @endif 

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="apellido" class="col-sm-4 col-form-label text-end"><strong>Apellido</strong></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{$datos->apellido??old('apellido') }}">
                                            @if ($errors->has('apellido'))
                                                <span class="text-danger">{{ $errors->first('apellido') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-4 col-form-label text-end"><strong>Email</strong></label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$datos->email??old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="telefono" class="col-sm-4 col-form-label text-end"><strong>Telefono</strong></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="{{$datos->telefono??old('telefono')}}">
                                            @if ($errors->has('telefono'))
                                                <span class="text-danger">{{ $errors->first('telefono') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="profesion" class="col-sm-4 col-form-label text-end"><strong>Profesion</strong></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="profesion" id="profesion" placeholder="profesion" value="{{$datos->profesion??old('profesion')}}">
                                            @if ($errors->has('profesion'))
                                                <span class="text-danger">{{ $errors->first('profesion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="gradoAcademico" class="col-sm-4 col-form-label text-end">Grado Academico</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="gradoAcademico" id="gradoAcademico">
                                                <option value="">Seleccione</option>
                                                <option value="BACHILLER" {{($datos->gradoAcademico == 'BACHILLER')?'selected':''}}>Bachiller</option>
                                                <option value="TITULADO" {{($datos->gradoAcademico == 'TITULADO')?'selected':''}}>TITULADO</option>
                                                <option value="MAGISTER" {{($datos->gradoAcademico == 'MAGISTER')?'selected':''}}>Magister</option>
                                                <option value="DOCTOR" {{($datos->gradoAcademico == 'DOCTOR')?'selected':''}}>Doctor</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('gradoAcademico'))
                                            <span class="text-danger text-center">{{ $errors->first('gradoAcademico') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="idPais" class="col-sm-4 col-form-label text-end">Pais</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" onchange="loadDepartamento(this)" name="idPais" id="idPais">
                                                <option value="">Seleccione</option>
                                                @foreach($pais as $pais)
                                                    <option value="{{$pais->id}}" {{($datos->idPais == $pais->id)?'selected':''}}>{{$pais->nombrePais}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('idPais'))
                                                <span class="text-danger">{{ $errors->first('idPais') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="idDepartamento" class="col-sm-4 col-form-label text-end">Departamento{{$datos->idDepartamento}}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" onchange="loadProvincia(this)" name="idDepartamento" id="idDepartamento">
                                                <option value="">Seleccione</option>
                                                @foreach ($departamento as $departamento)
                                                    <option {{old('idDepartamento') == $departamento->id ? 'selected' : ''}} value="{{$departamento->id}}" {{($datos->idDepartamento == $departamento->id)?'selected':''}}>{{$departamento->nombreDepartamento}}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('idDepartamento'))
                                                <span class="text-danger">{{ $errors->first('idDepartamento') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="idProvincia" class="col-sm-4 col-form-label text-end">Provincia {{$datos->idProvincia }}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" onchange="loadDistrito(this)" name="idProvincia" id="idProvincia">
                                                <option value="">Seleccione</option>
                                                @foreach ($provincia as $provincia)
                                                    <option {{old('idProvincia') == $provincia->id ? 'selected' : ''}} value="{{$provincia->id}}" {{($datos->idProvincia == $provincia->id)?'selected':''}}>{{$provincia->nombreProvincia}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('idProvincia'))
                                                <span class="text-danger">{{ $errors->first('idProvincia') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="idDistrito" class="col-sm-4 col-form-label text-end">Distrito {{$datos->idDistrito}}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="idDistrito" id="idDistrito">
                                                <option value="">Seleccione</option>  
                                                @foreach ($distrito as $distrito)
                                                    <option {{old('idDistrito') == $distrito->id ? 'selected' : ''}} value="{{$distrito->id}}" {{($datos->idDistrito == $distrito->id)?'selected':''}}>{{$distrito->nombreDistrito}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('idDistrito'))
                                                <span class="text-danger">{{ $errors->first('idDistrito') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="alert alert-info" role="alert">
                                        <h5 class="alert-heading text-center">Datos del curso a incribirse</h5>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="idCurso" class="col-sm-4 col-form-label text-end">Curso</label>
                                        <div class="col-sm-8">
                                            <input type="text" disabled class="form-control" name="nombreCurso" id="nombreCurso" placeholder="Curso" value="{{$curso->nombreCurso??''}}">
                                            <input type="hidden" name="idCurso" id="idCurso" value="{{$idCurso}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="montoPagado" class="col-sm-4 col-form-label text-end">Monto Pago</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="montoPagado" id="montoPagado" placeholder="00.00" value="{{$curso->montoPagado?? old('montoPagado')}}">
                                            @if ($errors->has('montoPagado'))
                                                <span class="text-danger">{{ $errors->first('montoPagado') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="fechaPago" class="col-sm-4 col-form-label text-end">Fecha Pago</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="fechaPago" id="fechaPago" placeholder="00.00" value="{{$curso->fechaPago?? old('fechaPago')}}">
                                            @if ($errors->has('fechaPago'))
                                                <span class="text-danger">{{ $errors->first('fechaPago') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                        <h5 class="alert-heading text-center">Datos de pago</h5>
                                        <p>Recuerde enviar la foto de operacion al numero de la coordinadora la cual 
                                            realizara la verificacion y validacion de la matricula
                                        </p>
                                        <h4 class="alert-heading ">Celular: 99980898 <span>(Samanta)</span></h4>
                                    </div>
                                    @if (session('success-registrado'))
                                        <div class="mb-3 row">
                                            <a type="button" class="btn btn-info"  href="{{ route('certificados.index')}}" >
                                                REGRESAR CURSO
                                            </a>
                                        </div>
                                    @else
                                        <div class="mb-3 row">
                                            <div class="col-sm-6 text-center">
                                                <a type="button" class="btn btn-danger"  href="{{ route('certificados.index')}}" >
                                                REGRESAR CURSO
                                                </a>
                                            </div>
                                            <div class="col-sm-6 text-center">
                                                <button type="submit" class="btn btn-success">INSCRIBIRME</button>
                                            </div>   
                                        </div>
                                        <div class="mb-3 row">
                                            
                                        </div> 
                                    @endif
                                </form>
                            @else
                                <div class="mb-3 row">
                                    <a type="button" class="btn btn-success"  href="{{ route('certificados.index')}}" >
                                        REGRESAR CURSO
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

