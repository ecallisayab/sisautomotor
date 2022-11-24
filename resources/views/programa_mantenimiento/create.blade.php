@extends('custom.app')

@section('title')
SisAutomotor - Mantenimientos programados
@endsection

@section('style_files')
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Nuevo mantenimiento programado</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('programa_mantenimiento.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Advertencia!</strong> Hubo algunos problemas con la entrada de datos.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('programa_mantenimiento.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" class="form-control" placeholder="Fecha" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tipo de mantenimiento:</label>
                                <select name="id_tipo" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($tipos_mantenimiento as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vehiculo:</label>
                                <select name="id_vehiculo" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($vehiculos as $item)
                                    <option value="{{ $item->id }}">{{ $item->marca.' '.$item->modelo.' ['.$item->matricula.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_files')
@endsection

@section('script')
@endsection