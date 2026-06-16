@extends('layouts.panel')
@section('title', 'Especialidades / Editar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Editar Especialidad') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('specialties.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('specialties.update', $specialty->id) }}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">{{ __('Nombre de la Especialidad') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $specialty->name) }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="specialty_description">{{ __('Descripción') }}</label>
                                {{-- Al editar, el contenido del textarea va directamente en medio de las etiquetas de cierre --}}
                                <textarea name="specialty_description" rows="3" class="form-control @error('specialty_description') is-invalid @enderror">{{ old('specialty_description', $specialty->specialty_description) }}</textarea>
                                @error('specialty_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
