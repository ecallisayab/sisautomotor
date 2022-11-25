@extends('custom.app')

@section('title')
SisAutomotor - Mantenimiento
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
                <h5>Editar mantenimiento (salida)</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('mantenimiento.index') }}">
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

                <form action="{{ route('mantenimiento_salida.update',$mantenimiento_salida->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha_salida" class="form-control" placeholder="Fecha" value="{{ $mantenimiento_salida->fecha_salida }}" min="{{ date('Y-m-d',time()-(86400*1)) }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado_salida" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}" @if ($mantenimiento_salida->id_empleado_salida == $item->id) selected @endif>{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    <option value="EN_PROCESO" @if ($mantenimiento_salida->estado == 'EN_PROCESO') selected @endif>EN PROCESO</option>
                                    <option value="CONCLUIDO" @if ($mantenimiento_salida->estado == 'CONCLUIDO') selected @endif>CONCLUIDO</option>
                                    <option value="CANCELADO" @if ($mantenimiento_salida->estado == 'CANCELADO') selected @endif>CANCELADO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descrip_salida" rows="3" required>{{ $mantenimiento_salida->descrip_salida }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs_salida" rows="3">{{ $mantenimiento_salida->obs_salida }}</textarea>
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