@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">EDITAR REGISTRO Nº {{$inscrito->id }}</h1>
        </div>
       
    </div>
    
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('registered.update', $inscrito)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6>Por favor corregir los siguientes errores:</h6>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="id" value="{{$inscrito->id}}">
                    <input type="hidden" name="idCurso" value="{{$curso->id}}">
                    <input type="hidden" name="idPersona" value="{{$persona->id}}">
                    <div class="mb-3 row">
                        <label for="nombreCurso" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombreCurso" id="nombreCurso" value="{{ $persona->nroDocumento}}" disabled >
                            
                            @error('nombreCurso')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="apellido" class="col-sm-2 col-form-label">Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="apellido" id="apellido" value="{{ $persona->apellido }}" >
                            
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $persona->nombre }}" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for ="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{ $persona->email}}">
                        </div> 
                    </div>
                    <div class="mb-3 row">
                        <label for="descripcionCurso" class="col-sm-2 col-form-label">Curso</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="descripcionCurso" id="descripcionCurso" placeholder="Descripción del curso" value="{{$curso->nombreCurso }}" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="montoPagado" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="montoPagado" id="montoPagado" placeholder="Cupo del curso" value="{{$inscrito->montoPagado }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fechaPago" class="col-sm-2 col-form-label">Fecha de Pago</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fechaPago" id="fechaPago"  value="{{$inscrito->fechaPago }}">
                            
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