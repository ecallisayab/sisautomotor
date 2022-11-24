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
                <h5>Editar tipo de mantenimiento</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('tipo_mantenimiento.index') }}">
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
                <form action="{{ route('tipo_mantenimiento.update',$tipo_mantenimiento->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                <input type="text" name="nombre" value="{{ $tipo_mantenimiento->nombre }}" class="form-control" placeholder="Nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <strong>Estado:</strong>
                                <select name="estado" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    <option value="ACTIVO" @if ($tipo_mantenimiento->estado == 'ACTIVO') selected @endif>ACTIVO</option>
                                    <option value="INACTIVO" @if ($tipo_mantenimiento->estado == 'INACTIVO') selected @endif>INACTIVO</option>
                                </select>
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