@extends('custom.app')

@section('title')
SisAutomotor - Salidas de Combustible
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
                <h5>Datos de salida de combustible</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('combustible_salida.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de salida:</strong>
                            {{ $combustible_salida[0]->id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $combustible_salida[0]->fecha_hora }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Combustible:</strong>
                            {{ $combustible_salida[0]->combustible }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Cantidad [litros]:</strong>
                            {{ $combustible_salida[0]->cantidad }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Resp. de transportes:</strong>
                            {{ $combustible_salida[0]->empleado }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Vehículo:</strong>
                            {{ $combustible_salida[0]->vehiculo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Responsable vehículo:</strong>
                            {{ $combustible_salida[0]->resp_vehiculo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Observación:</strong>
                            {{ $combustible_salida[0]->obs }}
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