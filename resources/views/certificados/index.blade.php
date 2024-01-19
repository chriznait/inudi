<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Certificado Inudi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
        <!--icons-->
        

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
                <div class="col-sm-3">
                    <div class="card shadow">
                        <div class="card-header text-bg-success  text-center">
                            <h5><strong>Menú Principal</strong></h5>
                        </div>
                        
                        <div class="list-group" id="menuList">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                Cursos y certificados
                            </a>
                            <a href="https://inudi.edu.pe" class="text-decoration-none text-dark list-group-item list-group-item-action">
                                <span icon="fas fa-bolt" class="glyphicon glyphicon-home" aria-hidden="true"></span> INUDI
                            </a>
                            <a href="https://inudi.edu.pe/revistas" class="text-decoration-none text-dark list-group-item list-group-item-action">Revista - INUDI</a>
                            <a href="https://campus.inudi.edu.pe/" class="text-decoration-none text-dark list-group-item list-group-item-action">Aula virtual - INUDI</a>
                            <a href="https://certificados.inudi.edu.pe/login" class="text-decoration-none text-dark list-group-item list-group-item-action">Admin - INUDI</a>
                        </div>
                    </div>
                    <br>
                    <div class="card border-success shadow">
                        <div class="card-header  text-center">
                            <h5><strong>Consultar certificado</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="mb-3 row">
                                    <label for="codigo" class="col-sm-4 col-form-label">Código</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 text-center">
                                        <a type="submit" class="btn btn-success disabled">Consultar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card border-success shadow">
                        <div class="card-header  text-center">
                            <h5><strong>Consulta todos tus certificados</strong></h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('certificados.buscar')}}" method="GET">
                                <div class="mb-3 row">
                                    <label for="dniBuscar" class="col-md-12 col-sm-12 col-xl-4 col-form-label"><strong>DNI:</strong></label>
                                    <div class="col-sm-12 col-md-12 col-xl-8">
                                        <input type="text" class="form-control" name="dniBuscar" id="dniBuscar" placeholder="DNI">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit"
                                        class="btn btn-success">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9" id="dvbody">
                    @foreach($courses as $course )
                        <div class="card-deck">
                            <div class="card">
                                @if($course->imagen!=null)
                                    <img src="{{ asset('cursos').'/'.$course->imagen}}" alt="" class="card-img-top img-responsive">
                                @endif
                                
                                <div class="card-body">
                                    <h2 class="card-title text-center titulo">
                                        <strong>{{$course->nombreCurso}}</strong>
                                    </h2>
                                    <p class="card-text">
                                        {{$course->descripcionCurso}}
                                    </p>
                                    <span class="spanIni">
                                        <strong>Fecha de inicio: </strong>{{$course->fechaInicio}}
                                    </span>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-8">
                                            <span>
                                                Inscripciones del {{
                                                    \Carbon\Carbon::parse
                                                ($course->fechaInicioInscripcion)->format('d/m/Y')
                                                }} al {{
                                                    \Carbon\Carbon::parse
                                                 ($course->fechaFinInscripcion)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="col-sm-4">
                                            @if(\Carbon\Carbon::parse($course->fechaInicioInscripcion)->format('Y-m-d') <= \Carbon\Carbon::now()->format('Y-m-d') && \Carbon\Carbon::parse($course->fechaFinInscripcion)->format('Y-m-d') >= \Carbon\Carbon::now()->format('Y-m-d'))
                                                
                                            <button type="button" class="btn btn-primary float-end modalInscripcion" data-id="{{$course->id}}" data-toggle="modal" data-target="#modal-inscripcion" data-whatever="{{$course->id}}">
                                                Inscribirse
                                            </button>
                                            @else
                                            <a href="#" class="btn btn-secondary float-end disabled">
                                                Finalizado
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach 
                    
                    @include('certificados.modal')
                </div>           
            </div>
        </div>
    </body>
</html>
