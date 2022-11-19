@extends('custom.app')

@section('title')
SisAutomotor - Proveedores
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
                <h5>Datos de proveedor</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('proveedor.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $proveedor->nombre }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $proveedor->direccion }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Teléfono principal:</strong>
                            {{ $proveedor->fono_1 }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Teléfono secundario:</strong>
                            {{ $proveedor->fono_2 }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Correo-e:</strong>
                            {{ $proveedor->correo }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $proveedor->descrip }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $proveedor->estado }}
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