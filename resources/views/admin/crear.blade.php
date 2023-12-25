@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">USUARIO</h1>
        </div>
       
    </div>

@stop
@section('content')
    
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nuevo usuario</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" >
                            
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" >
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" >
                            @error('password')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                            @error('password_confirmation')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{
                                route('admin.usuarios')
                            }}" class="btn btn-danger">Cancelar</a>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info">Crear Usuario</button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

@stop