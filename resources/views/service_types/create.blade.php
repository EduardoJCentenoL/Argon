@extends('layouts.panel')
@section('title', 'Service_types / Crear')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Crear Nuevo Registro') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('service_types.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('service_types.store') }}" specialty="form">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Nombre del Servicio') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej. Preventivo o Correctivo...">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            </div>

                            <div class="form-group">
                                <label for="service_description">{{ __('Descripcion') }}</label>
                                <textarea name="service_description" rows="3" class="form-control @error('service_description') is-invalid @enderror" placeholder="Describa brevemente las tareas o caracteristicas de este servicio...">{{ old('service_description') }}</textarea>
                                @error('service_description') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            </div>

                            <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
