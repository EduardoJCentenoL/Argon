@extends('layouts.panel')
@section('title', 'Tipos de Servicio / Editar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Editar Tipo de Servicio') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('service_types.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('service_types.update', $specialty->id) }}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">{{ __('Nombre de la Tipo de Servicio') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $specialty->name) }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="service_description">{{ __('Descripción') }}</label>
                                {{-- Al editar, el contenido del textarea va directamente en medio de las etiquetas de cierre --}}
                                <textarea name="service_description" rows="3" class="form-control @error('service_description') is-invalid @enderror">{{ old('service_description', $specialty->service_description) }}</textarea>
                                @error('service_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
