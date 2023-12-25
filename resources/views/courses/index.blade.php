@extends('adminlte::page')

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
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <form action="{{route('courses.index')}}" method="get">
                        <div class="mb-3 row">
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm rounded border-primary text-secondary" name="filterValue" placeholder="Buscar" >
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-sm btn-info">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover" id="courses">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="40%" >Nombre</th>
                        <th>Codigo</th>
                        <th>F Inicio</th>
                        <th>Capacidad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->nombreCurso }}</td>
                            <td>
                                {{$course->abrCurso}}
                            </td>
                            <td>{{$course->fechaInicio}}</td>
                            <td>{{$course->cupo}}</td>
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Seguro que desea eliminar?');">Eliminar</button>
                                </form>
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info @if($course->cupo == 0) disabled @endif">Mostrar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="text-center col-md-3">
                {{$courses->links()}}
            </div>
            </div>
            
        </div>
    </div>
@stop
