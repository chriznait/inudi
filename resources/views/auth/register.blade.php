@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Error 404') }}</div>

                    <div class="card-body">
                        <h1>{{ __('Pagina no encontrada
                        ') }}</h1>
                        <p>{{ __('La pagina que buscas no existe.') }}</p>
                    </div>
                </div>
                

            </div>
            <div class="col-md-8">
                <button class="btn btn-primary" onclick="window.history.back();">Volver</button>
            </div>
        </div>
    </div>
@endsection

