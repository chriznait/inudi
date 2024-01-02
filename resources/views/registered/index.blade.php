@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar inscritos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('courses.index')}}" class="breadcrumb-item">Academido</a>
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
                    <a href="{{route('admin.crear')}}" class="btn btn-primary float-right">Agregar Usuario</a>
                </div>
                @if (session('success-destroy'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('success-destroy') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Editar</a>
                                <a href="{{ route('registered.matricular', $inscrito->id) }}" class="btn btn-success btn-sm">Matricular</a>
                                <form action="{{ route('registered.destroy', $inscrito->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop