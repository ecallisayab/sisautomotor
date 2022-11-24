@extends('custom.app')

@section('title')
SisAutomotor - Vehiculo
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
                <h5>Editar vehiculo</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('vehiculo.index') }}">
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
                <form action="{{ route('vehiculo.update',$vehiculo->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Matricula:</label>
                                <input type="text" name="matricula" value="{{ $vehiculo->matricula }}" class="form-control" placeholder="Matricula" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Marca:</label>
                                <input type="text" name="marca" value="{{ $vehiculo->marca }}" class="form-control" placeholder="Marca" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" name="modelo" value="{{ $vehiculo->modelo }}" class="form-control" placeholder="Modelo" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Color:</label>
                                <input type="text" name="color" value="{{ $vehiculo->color }}" class="form-control" placeholder="color">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tipo:</label>
                                <input type="text" name="tipo" value="{{ $vehiculo->tipo }}" class="form-control" placeholder="Tipo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descrip" class="form-control" rows="3">{{ $vehiculo->descrip }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control" required>
                                    <option value=""--Seleccione una opción--></option>
                                    <option value="ACTIVO" @if ($vehiculo->estado == 'ACTIVO') selected @endif>ACTIVO</option>
                                    <option value="INACTIVO" @if ($vehiculo->estado == 'INACTIVO') selected @endif>INACTIVO</option>
                                    <option value="EN_MANTENIMIENTO" @if ($vehiculo->estado == 'EN_MANTENIMIENTO') selected @endif>EN MANTENIMIENTO</option>
                                    <option value="DISPONIBLE" @if ($vehiculo->estado == 'DISPONIBLE') selected @endif>DISPONIBLE</option>
                                    <option value="NO_DISPONIBLE" @if ($vehiculo->estado == 'NO_DISPONIBLE') selected @endif>NO DISPONIBLE</option>
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