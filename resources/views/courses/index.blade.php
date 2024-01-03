@extends('adminlte::page')
@section('css')

    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#courses').DataTable({
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
            <h1 class="m-0 text-dark">CURSOS</h1>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            <strong>{{session('success')}}</strong>
        </div>
    @elseif(session('success-update'))
        <div class="alert alert-info text-center">
            <strong>{{session('success-update')}}</strong>
        </div>
    @elseif(session('success-delete'))
        <div class="alert alert-danger text-center">
            <strong>{{session('success-delete')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-header container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <a href="{{route('courses.create') }}" class="btn btn-primary">Crear curso</a>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover" id="courses">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>ID</th>
                        <th width="40%" >Nombre</th>
                        <th>Codigo</th>
                        <th>F Inicio</th>
                        <th>Capacidad</th>
                        <th>Whassap</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                            <td>{{$course->nombreCurso }}</td>
                            <td>
                                {{$course->abrCurso}}
                            </td>
                            <td>{{$course->fechaInicio}}</td>
                            <td>{{$course->cupo}}/ {{$course->registered}}
                             </td>
                            <td class="text-center">
                                @if($course->linkGrupo == null)
                                    <span class="text-danger">No disponible</span>
                                @else
                                    <a href="{{$course->linkGrupo}}" target="_blank" class="btn btn-sm btn-success">
                                        <span class="fab fa-whatsapp"></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">
                                <span class="fas fa-edit"></span>
                                </a>
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info @if($course->cupo == 0) disabled @endif">Ver</a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Seguro que desea eliminar?');">
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
