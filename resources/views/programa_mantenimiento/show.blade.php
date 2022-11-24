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
                <h5>Datos de mantenimiento programado</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('programa_mantenimiento.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $programacion_mantenimiento[0]->fecha }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Tipo de mantenimiento:</strong>
                            {{ $programacion_mantenimiento[0]->tipo_mantenimiento }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Vehículo:</strong>
                            {{ $programacion_mantenimiento[0]->vehiculo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $programacion_mantenimiento[0]->estado }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Observación:</strong>
                            {{ $programacion_mantenimiento[0]->obs }}
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