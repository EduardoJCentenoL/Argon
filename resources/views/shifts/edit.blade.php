@extends('layouts.panel')
@section('title', 'Shifts / Editar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Editar Registro') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('shifts.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('shifts.update', $shift->id) }}" shift="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">{{ __('Nombre') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $shift->name) }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="start_time">{{ __('Hora de Inicio') }}</label>
                                <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', date('H:i', strtotime($shift->start_time))) }}">
                                @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="end_time">{{ __('Hora de Fin') }}</label>
                                <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', date('H:i', strtotime($shift->end_time))) }}">
                                @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
