@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">EDITAR CURSO Nº {{$course->id }}</h1>
        </div>
       
    </div>
    
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('courses.update', $course)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="mb-3 row">
                        <label for="nombreCurso" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombreCurso" id="nombreCurso" value="{{ $course->nombreCurso}}" >
                            
                            @error('nombreCurso')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="abrCurso" class="col-sm-2 col-form-label">Abreviatura</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="abrCurso" id="abrCurso" value="{{ $course->abrCurso}}" >
                            @error('abrCurso')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="descripcionCurso" class="col-sm-2 col-form-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="descripcionCurso" id="descripcionCurso" placeholder="Descripción del curso" value="{{$course->descripcionCurso }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cupo" class="col-sm-2 col-form-label">Cupo</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="cupo" id="cupo" placeholder="Cupo del curso" value="{{$course->cupo }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fechaInicio" class="col-sm-2 col-form-label">Fecha de inicio</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" placeholder="Fecha de inicio del curso" value="{{$course->fechaInicio }}">
                            
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fechaFin" class="col-sm-2 col-form-label">Fecha de fin</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fechaFin" id="fechaFin" placeholder="Fecha de fin del curso" value={{ $course->fechaFin }} >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="horaInicio" class="col-sm-2 col-form-label">Fe Ini Inscripcion</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fechaInicioInscripcion" id="fechaInicioInscripcion" placeholder="Inicio Inscrpcion" value="{{$course->fechaInicioInscripcion }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="horaFin" class="col-sm-2 col-form-label">Fe Fin Inscripcion</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fechaFinInscripcion" id="fechaFinInscripcion" placeholder="Fin Inscripcion" value="{{$course->fechaFinInscripcion }}">
                            
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modificar Registro</button>
                    <a href="{{route('courses.index')}}" class="btn btn-secondary">Cancelar</a>
                </div>
                
            </form>
        </div>
    </div>
   

@stop