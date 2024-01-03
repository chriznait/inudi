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
                    <strong>PLATAFORMA DE CERTIFICACION DE CURSOS, DIPLOMAS Y OTROS</strong>
                </h1>
                <p class="text-center instituto">
                    <strong>INSTITUTO UNIVERSITARIO DE INVESTIGACIÓN INUDI PERÚ</strong>
                </p>
            </div>
        </section>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
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
                                        <a type="submit" class="btn btn-success">Consultar</a>
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
                            <form action="">
                                <div class="mb-3 row">
                                    <label for="dniBuscar" class="col-sm-4 col-form-label"><strong>DNI:</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dniBuscar" id="dniBuscar" placeholder="DNI">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 text-center">
                                        <a type="submit" href="{{ route('certificados.buscar') }}"
                                        class="btn btn-success">Buscar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9" id="dvbody">
                    <div class="card border-primary mb-3">
                        <div class="card-header">
                            <h5 class="card-title text-center text-primary">REGISTRO DE CERTIFICADOS DE:</h5>
                            <h4 class="card-title"> Alumno(a): <strong>{{ $datos->nombre }} {{ $datos->apellido }}</strong></h4>
                            <h5 class="card-title">Dni: <strong>{{ $datos->nroDocumento }}</strong></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered">
                                    <thead class="table-primary text-center">
                                        <tr class="primary">
                                            <th scope="col">Nro</th>
                                            <th scope="col">Código</th>
                                            <th scope="col">Curso</th>
                                            <th scope="col">Fe. Emitido</th>
                                            <th scope="col">Certificado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificados as $certificado)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $certificado->codigoCertificado }}</td>
                                            <td>{{ $certificado->nombreCurso }}</td>
                                            <td>{{ $certificado->fechaCertificado }}</td>
                                            <td class="text-center">
                                                <a href="{{
                                                    asset('storage/certificados/'.$certificado->codigoCertificado.'.pdf')
                                                }}
                                                " class="btn btn-success btn-sm">Visualizar</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('certificados.index') }}" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
        <br>
        <footer class="footer text-center text-lg-start text-white" >
            
                <section class=" "style="background-color: #6351ce">
                
                    <div class="container text-center text-md-start mt-5">
                        <div class="row mt-3">
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-3">
                                <img src="{{ asset('img/logo.png') }}" alt="" width="100px">
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-5">
                                <!-- Content -->
                                <br>
                                <h6 class="text-uppercase fw-bold">INUDI - PERÚ</h6>
                                <hr
                                    class="mb-4 mt-0 d-inline-block mx-auto"
                                    style="width: 60px; background-color: #7c4dff; height: 2px"
                                    />
                                <p>
                                    El Instituto Universitario de Innovación Ciencia y Tecnología Inudi Perú te ofrece la formación académica de educación continua en diplomados, cursos, especializaciones y posdoctorados. Te conduce a la certificación de diplomas y certificados de nivel universitario.
                                </p>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                <br>
                                <h6 class="text-uppercase fw-bold mb-4">
                                    <strong>REVISTAS</strong>
                                </h6>
                                <p>
                                    <a href="https://revistainnovaeducacion.com/index.php/rie/issue/archive" class="text-reset">Revista Innova Educacion</a>
                                </p>
                                <p>
                                    <a href="https://accionesmedicas.com/index.php/ram" class="text-reset">Acciones Médicas</a>
                                </p>
                                
                            </div>
                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                <br>
                                <h6 class="text-uppercase fw-bold mb-4">
                                    <strong>Contacto</strong>
                                </h6>
                                <p><i class="fas fa-home me-3"></i> Puno, Perú</p>
                                <p>
                                    <i class="fas fa-envelope me-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                        <span>
                            INSTITUTO UNIVERSITARIO DE INVESTIGACIÓN INUDI PERÚ
                            © 2024
                        </span>

                    </div>

                </section>
            
        </footer>
    </body>
</html>
