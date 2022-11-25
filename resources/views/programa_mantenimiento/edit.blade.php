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
                <h5>Editar mantenimiento programado</h5>
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
                <form action="{{ route('programa_mantenimiento.update',$programacion_mantenimiento->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" value="{{ $programacion_mantenimiento->fecha }}" class="form-control" placeholder="Fecha" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tipo de mantenimiento:</label>
                                <select name="id_tipo" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($tipos_mantenimiento as $item)
                                    <option value="{{ $item->id }}" @if ($programacion_mantenimiento->id_tipo == $item->id) selected @endif>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vehiculo:</label>
                                <select name="id_vehiculo" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($vehiculos as $item)
                                    <option value="{{ $item->id }}" @if ($programacion_mantenimiento->id_vehiculo == $item->id) selected @endif>{{ $item->marca.' '.$item->modelo.' ['.$item->matricula.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3">{{ $programacion_mantenimiento->obs }}</textarea>
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