@extends('layouts.panel')
@section('title', 'Shifts / Index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">{{ __('Shifts') }}</span>
                            <div class="float-right">
                                <a href="{{ route('shifts.create') }}" class="btn btn-primary btn-sm float-right">
                                    {{ __('Crear Nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4"><p>{{ $message }}</p></div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Hora de Inicio</th>
                                        <th>Hora de Finalización</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shifts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            {{-- Mostramos las horas cortadas de forma limpia (ej: 08:00) --}}
                                            <td>{{ date('H:i a', strtotime($item->start_time)) }}</td>
                                            <td>{{ date('H:i a', strtotime($item->end_time)) }}</td>
                                            <td>
                                                <form action="{{ route('shifts.destroy', $item->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('shifts.edit', $item->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
