@extends('custom.app')

@section('title')
SisAutomotor - Entrada de Vehículo
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
                <h5>Datos de entrada de vehículo</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('vehiculo_entrada.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de entradas:</strong>
                            {{ $vehiculo_entrada[0]->id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $vehiculo_entrada[0]->fecha_hora }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Resp. de transportes:</strong>
                            {{ $vehiculo_entrada[0]->empleado }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Vehículo:</strong>
                            {{ $vehiculo_entrada[0]->vehiculo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Responsable vehículo:</strong>
                            {{ $vehiculo_entrada[0]->resp_vehiculo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Observación:</strong>
                            {{ $vehiculo_entrada[0]->obs }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_files')
@endsection

@section('script')
@endsection