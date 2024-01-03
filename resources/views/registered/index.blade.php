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
@endsection

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar inscritos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('courses.index')}}" class="breadcrumb-item">Academico</a>
                </li>
                <li class="breadcrumb-item active">pre-matricula</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">Inscritos al curso: <strong>{{ $curso->nombreCurso 
                        }}</strong></h3>
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-primary float-right btn-sm">Agregar inscrito</a>
                </div>
                @if (session('success-destroy'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('success-destroy') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>
            <div class="row">
                @if ( $curso->linkGrupo == null )
                    <div class="col-sm-6">
                        <span class="badge badge-danger">Debe crear un link de grupo para enviar a los correos registrados</span>
                    </div> 
                @else
                    <div class="col-sm-6">
                        <a href="{{ $curso->linkGrupo }}" target="_blank" class="btn btn-success btn-sm">Link de grupo</a>
                    </div>
    
                @endif
                <div class="col-sm-6">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="{{ route('registered.export', $curso->id) }}"
                         class="btn btn-outline-primary btn-sm">
                            <span class="fas fa-file-excel"> Excel</span>
                        </a>
                        <a href="" class="btn btn-outline-danger btn-sm">
                            <span class="fas fa-file-pdf"> PDF</span>
                        </a> 
                    </div>
                    
                </div>
            </div>

        </div>

        <div class="card-body">
            <table id="registros" class="table table-bordered table-striped">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Nª Doc.</th>
                        <th>Nombre</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Monto</th>
                        <th>F. Pago</th>
                        <th>F. Matricula</th>
                        <th>Estado</th>
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
                            <td>{{ $inscrito->montoPagado }}</td>
                            <td>{{ $inscrito->fechaPago }}</td>
                            <td>{{ $inscrito->fechaMatricula }}</td>
                            <td>
                                @if ($inscrito->estado == 1)
                                    <span class="badge badge-danger">Pendiente</span>
                                @elseif ($inscrito->estado == 2)
                                    <span class="badge badge-success">Matriculado</span>
                                @elseif ($inscrito->estado == 3 )
                                    <span class="badge badge-info">Certificado</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">
                                    <span class="fas fa-edit "></span>
                                </a>
                                @if($curso->linkGrupo != null && $inscrito->estado == 1)
                                    <a href="{{ route('registered.matricular', $inscrito->id) }}" class="btn btn-success btn-sm">Matricular </a>
                                @endif
                                <form action="{{ route('registered.destroy', $inscrito->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar?')">
                                    <span class="fas fa-trash-alt"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop