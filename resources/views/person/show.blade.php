@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Estudiantes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('person.index')}}" class="breadcrumb-item">Estudiantes</a>
                </li>
                <li class="breadcrumb-item active">Detalle</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-center bg bg-info">DATOS PERSONALES</h5>
            <div class="card card bg-light d-flex flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Nombre:</strong> {{ $persona->nombre }} {{ $persona->apellido }}</p>
                            <p><strong>Correo:</strong> {{ $persona->email }}</p>
                            <p><strong>Telefono:</strong> {{ $persona->telefono }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Profesion:</strong> {{ $persona->profesion }}</p>
                            <p><strong>Grado Academico:</strong> {{ $persona->gradoAcademico }}</p>
                            <p><strong>Pais:</strong> {{ $pais->nombrePais }}</p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Ubicación:</strong>
                                {{ $departamento->nombreDepartamento }} -
                                {{ $provincia->nombreProvincia }} - 
                                {{ $distrito->nombreDistrito}}
                            </p>
                        </div>
                    </div>
                </div> 
            </div> 

        </div>
        <div class="card-body">
            <h5 class="text-center bg bg-success">CURSOS SEGUIDOS</h5>
            <table class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th>Nombre Curso</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Monto</th>
                        <th>Fecha Pago</th>
                        <th>Estado</th>
                        <th>Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td>{{ $curso->nombreCurso }}</td>
                            <td>{{ $curso->fechaInicio }}</td>
                            <td>{{ $curso->fechaFin }}</td>
                            <td>{{ $curso->montoPagado }}</td>
                            <td>{{ $curso->fechaPago }}</td>
                            <td>{{ $curso->estado }}</td>
                            <td class="text-center">
                                @if($curso->codigoCertificado)
                                    <a href="{{ asset('storage/certificados/'.$curso->codigoCertificado.'.pdf') }}" target="_blank">
                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                    </a>
                                @else
                                    <i class="fas fa-file-pdf fa-2x text-secondary"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@stop