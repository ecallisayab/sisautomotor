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
                <h5>Editar mantenimiento (entrada)</h5>
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

                <form action="{{ route('mantenimiento_entrada.update',$mantenimiento_entrada->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha_entrada" class="form-control" placeholder="Fecha" value="{{ $mantenimiento_entrada->fecha_entrada }}" min="{{ date('Y-m-d',time()-(86400*1)) }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tipo de mantenimiento:</label>
                                <select name="id_tipo" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($tipos_mantenimiento as $item)
                                    <option value="{{ $item->id }}" @if ($mantenimiento_entrada->id_tipo == $item->id) selected @endif>{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vehículo:</label>
                                <select name="id_vehiculo" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($vehiculos as $item)
                                    <option value="{{ $item->id }}" @if ($mantenimiento_entrada->id_vehiculo == $item->id) selected @endif>{{ $item->marca.' '.$item->modelo.' ['.$item->matricula.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Diagnóstico:</label>
                                <input type="text" name="diagnostico_entrada" class="form-control" placeholder="Diagnóstico" value="{{ $mantenimiento_entrada->diagnostico_entrada }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descrip_entrada" rows="3" required>{{ $mantenimiento_entrada->descrip_entrada }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado_entrada" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}" @if ($mantenimiento_entrada->id_empleado_entrada == $item->id) selected @endif>{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    <option value="EN_PROCESO" @if ($mantenimiento_entrada->estado == 'EN_PROCESO') selected @endif>EN PROCESO</option>
                                    <option value="CONCLUIDO" @if ($mantenimiento_entrada->estado == 'CONCLUIDO') selected @endif>CONCLUIDO</option>
                                    <option value="CANCELADO" @if ($mantenimiento_entrada->estado == 'CANCELADO') selected @endif>CANCELADO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs_entrada" rows="3">{{ $mantenimiento_entrada->obs_entrada }}</textarea>
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