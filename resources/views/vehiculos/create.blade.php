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
                <h5>Nuevo vehículo</h5>
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

                <form action="{{ route('vehiculo.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Matrícula:</label>
                                <input type="text" name="matricula" min="1" max="10" class="form-control" value="{{old('matricula')}}" placeholder="Matricula" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Marca:</label>
                                <input type="text" name="marca" class="form-control" value="{{old('marca')}}" placeholder="Marca" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Modelo:</label>
                                <input type="text" name="modelo" class="form-control" value="{{old('modelo')}}" placeholder="Modelo" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Color:</label>
                                <input type="text" name="color" class="form-control" value="{{old('color')}}" placeholder="Color">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tipo:</label>
                                <input type="text" name="tipo" class="form-control" value="{{old('tipo')}}" placeholder="Tipo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea name="descrip" class="form-control" value="{{old('descrip')}}" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" value="{{old('estado')}}" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="EN_MANTENIMIENTO">EN MANTENIMIENTO</option>
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