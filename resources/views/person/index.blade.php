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
            <h1 class="m-0 text-dark">REGISTRO DE PERSONAS</h1>
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <a href="{{route('person.create') }}" class="btn btn-primary float-right">
                        <span class="fas fa-plus-circle"></span> Crear persona
                    </a>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover table-responsive " id="courses">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>ID</th>
                        <th>Dni</th>
                        <th>Apellidos</th>
                        <th width="40%" >Nombre</th>
                        <th>email</th>
                        <th>telefono</th>
                        <th>Profesion</th>
                        <th>Domicilio</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($persons as $person)
                        <tr>
                            <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                            <td>{{$person->nroDocumento }} </td>
                            <td>
                                {{$person->apellido}}
                            </td>
                            <td>{{$person->nombre }}</td>
                            <td>{{$person->email}}</td>
                            <td>{{$person->telefono}}</td>
                            <td>{{$person->profesion}}</td>
                            <td>
                                {{$person->departamento}} - {{$person->provincia}} - {{$person->distrito}}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('person.edit', $person) }}" class="btn btn-sm btn-primary">
                                    <span class="fas fa-edit "></span>
                                </a>
                                <form action="{{ route('person.destroy', $person) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Seguro que desea eliminar?');">
                                        <span class="fas fa-trash-alt"></span>
                                    </button>
                                </form>
                                <a href="{{ route('person.show', $person) }}" class="btn btn-sm btn-info">
                                    <span class="fas fa-eye "></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@stop
