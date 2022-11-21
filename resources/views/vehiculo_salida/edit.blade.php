@extends('custom.app')

@section('title')
SisAutomotor - Salidas de Vehículo
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
                <h5>Editar salida de vehiculo</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('vehiculo_salida.index') }}">
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

                <form action="{{ route('vehiculo_salida.update',$vehiculo_salida->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" class="form-control" placeholder="Fecha" value="{{ $vehiculo_salida->fecha }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}" @if ($vehiculo_salida->id_empleado == $item->id) selected @endif>{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vehículo:</label>
                                <select name="id_vehiculo" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($vehiculos as $item)
                                    <option value="{{ $item->id }}" @if ($vehiculo_salida->id_vehiculo == $item->id) selected @endif>{{ $item->marca.' '.$item->modelo.' ['.$item->matricula.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. vehículo:</label>
                                <input type="text" name="resp_vehiculo" class="form-control" placeholder="Resp. vehículo" value="{{ $vehiculo_salida->resp_vehiculo }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Proyecto:</label>
                                <select name="id_proyecto" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($proyectos as $item)
                                    <option value="{{ $item->id }}" @if ($vehiculo_salida->id_proyecto == $item->id) selected @endif>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3">{{ $vehiculo_salida->obs }}</textarea>
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