@extends('custom.app')

@section('title')
SisAutomotor - Seguimiento a mantenimiento
@endsection

@section('style_files')
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body alert-primary">
                <strong>MANTENIMIENTO N°: {{ $seguimiento[0]->id_mantenimiento }}</strong> 
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Datos de seguimiento</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('seguimiento_mantenimiento.index', $seguimiento[0]->id_mantenimiento) }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de seguimiento:</strong>
                            {{ $seguimiento[0]->id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Fecha y hora:</strong>
                            {{ $seguimiento[0]->fecha_hora }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de mantenimiento:</strong>
                            {{ $seguimiento[0]->id_mantenimiento }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $seguimiento[0]->descrip }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Resp. de transportes:</strong>
                            {{ $seguimiento[0]->empleado }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Observación:</strong>
                            {{ $seguimiento[0]->obs }}
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