@extends('adminlte::page')
@section('css')

    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#registros').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "No se encontro ningun registro",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('js/certificado.js') }}" defer></script>
@endsection

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Matriculados</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('matriculado.index')}}" class="breadcrumb-item">Academico</a>
                </li>
                <li class="breadcrumb-item active">Matriculados</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">
                        Inscritos al curso: <strong>{{ $curso->nombreCurso}}</strong>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                        data-target="#generarCertificados" data-id="{{ $curso->id}}">
                        <span class="fas fa-file-pdf
                        "></span>
                        Generar Certificado
                    </button> 
                    <a href="" class="btn btn-success float-right btn-sm">
                        Descargar Certificado
                    </a>
                </div>

                @if (session('success-destroy'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('success-destroy') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('generado'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('generado') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>
            <hr>
            <div class="row">
                
                <div class="col-sm-6">
                    @if($total != 0)
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('registered.export', $curso->id) }}"
                            class="btn btn-outline-primary btn-sm">
                                <span class="fas fa-file-excel"> Excel</span>
                            </a>
                            <a href="" class="btn btn-outline-danger btn-sm">
                                <span class="fas fa-file-pdf"> PDF</span>
                            </a> 
                        </div>
                    @endif
                    
                </div>
            </div>

        </div>

        <div class="card-body">
            <table id="registros" class="table table-bordered table-striped table-responsive ">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Nª Doc.</th>
                        <th>Nombre</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Codigo</th>
                        <th>Asistencia</th>
                        <th>Nota</th>
                        <th>Certificado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscritos as $inscrito)
                        <tr>
                            <td> {{ $inscrito->nroDocumento }}</td>
                            <td>{{ $inscrito->nombre }} {{ $inscrito->apellido }}</td>
                            <td>{{ $inscrito->telefono }}</td>
                            <td>{{ $inscrito->email }}</td>
                            <td>{{ $inscrito->codigoCertificado }}</td>
                            <td></td>
                            <td>{{ $inscrito->nota }}</td>
                            <td class="text-center">
                                @if ($inscrito->estado == 3 || $inscrito->estado == 2)
                                    <span class="badge badge-danger">NO</span>
                                @elseif ($inscrito->estado == 4)
                                    <span class="badge badge-success">SI</span>
                                @elseif ($inscrito->estado == 5)
                                    <span class="badge badge-primary">Generado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success btnCertificado" data-toggle="modal"
                                    data-target="#modal-certificados" data-id="{{ $inscrito->id }}">
                        
                                    <span class="fas fa-edit"></span>
                                </button>
                                @if($inscrito->estado == 4 || $inscrito->estado == 5)
                                    <a href="{{ route('matriculados.download', $inscrito->id) }}" class="btn btn-sm btn-danger">
                                        <span class="fas fa-download"></span>
                                    </a>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @include('matriculados.modalCertificado')
    <!--GENERAR CERTIFICADO MODAL-->
    <div class="modal fade" id="generarCertificados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h5 class="modal-title " id="staticBackdropLabel"><b>Generar certificados</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              
            </div>
            <span class="text-red">
                (*) Se generarán los certificados a todos los alumnos pendientes por generar su certificado, con la nota ingresada.
              </span>
            <div class="modal-body">
                <form id="formGenerarCertificado" action="{{ route('matriculados.generarCertificado')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" name="idCurso" id="idCurso" value="">
                        </div>
                        <div class="col-sm-12">
                            <label for="nota">Nota:</label>
                            <input type="text" name="nota" id="nota" class="form-control" value=''>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-primary float-right">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
@stop