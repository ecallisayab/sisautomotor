@extends('custom.app')

@section('title')
SisAutomotor - Entradas de Combustible
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
                <h5>Editar entrada de combustible</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('combustible_entrada.index') }}">
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

                <form action="{{ route('combustible_entrada.update',$combustible_entrada->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" class="form-control" placeholder="Fecha" value="{{ $combustible_entrada->fecha }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Combustible:</label>
                                <select name="id_combustible" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($combustibles as $item)
                                    <option value="{{ $item->id }}" @if ($combustible_entrada->id_combustible == $item->id) selected @endif>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cantidad:</label>
                                <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ $combustible_entrada->cantidad }}" min="1" max="500000" step="any" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}" @if ($combustible_entrada->id_empleado == $item->id) selected @endif>{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Proveedor:</label>
                                <select name="id_proveedor" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    @foreach ($proveedores as $item)
                                    <option value="{{ $item->id }}" @if ($combustible_entrada->id_proveedor == $item->id) selected @endif>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Empleado proveedor:</label>
                                <input type="text" name="emp_proveedor" class="form-control" placeholder="Emp. proveedor" value="{{ $combustible_entrada->emp_proveedor }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3">{{ $combustible_entrada->obs }}</textarea>
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