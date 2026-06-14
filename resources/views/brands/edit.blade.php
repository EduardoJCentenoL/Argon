@extends('layouts.panel')
@section('title', 'Marcas / Editar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Editar Marca') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('brands.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('brands.update', $brand->id) }}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">{{ __('Nombre') }}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $brand->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('Actualizar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
