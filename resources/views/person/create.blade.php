@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">AGREGAR PERSONAL</h1>
        </div>
       
    </div>
    
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('person.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="tipoDocumento">1. Tip Documento</label>
                            <select name="tipoDocumento" id="tipoDocumento" class="form-control">
                                <option value="DNI">DNI</option>
                                <option value="CARNET DE EXTRANJERIA">CARNET DE EXTRANJERIA</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                        </div>
                        <div class="form-group">  
                            <label for="nroDocumento">2. DNI</label>
                            <input type="text" class="form-control" name="nroDocumento" id="nroDocumento" placeholder="Ingrese DNI" value="{{old('nroDocumento')}}">
                            @error('nroDocumento')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre">3. Nombres</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombres" value="{{old('nombre')}}">
                            @error('nombre')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="apellido">4. Apellidos</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellidos" value="{{old('apellido')}}">
                            @error('apellido')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">5. Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese Email" value="{{old('email')}}">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefono">6. Telefono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese Telefono" value="{{old('telefono')}}">
                            @error('telefono')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="profesion">7. Profesion</label>
                            <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Ingrese Profesion" value="{{old('profesion')}}">
                            @error('profesion')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gradoAcademico">8. Grado Academico</label>
                            <select name="gradoAcademico" id="gradoAcademico" class="form-control">
                                <option value="">Seleccione una opcion</option>
                                <option value="BACHILLER">BACHILLER</option>
                                <option value="TITULADO">TITULADO</option>
                                <option value="MAGISTER">MAGISTER</option>
                                <option value="DOCTOR">DOCTOR</option>
                                <option value="ESTUDIANTE">ESTUDIANTE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pais">9. Pais</label>
                            <select name="pais" id="pais" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="">Seleccione una opcion</option>
                                <option value="1">PERU</option>
                                <option value="2">ARGENTINA</option>
                                <option value="3">BOLIVIA</option>
                                <option value="4">BRASIL</option>
                                <option value="5">CHILE</option>
                                <option value="6">COLOMBIA</option>
                                <option value="7">ECUADOR</option>
                                <option value="8">PARAGUAY</option>
                                <option value="9">URUGUAY</option>
                                <option value="10">VENEZUELA</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{route('courses.index')}}" class="btn btn-secondary">Cancelar</a>
                </div>
                
            </form>
        </div>
    </div>
   

@stop