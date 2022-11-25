@extends('custom.app')

@section('title')
SisAutomotor - Tipos de mantenimiento
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
                <h5>Datos de tipo de mantenimiento</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('tipo_mantenimiento.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de registro:</strong>
                            {{ $tipo_mantenimiento->id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $tipo_mantenimiento->nombre }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $tipo_mantenimiento->estado }}
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