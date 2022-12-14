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
                <h5>Editar proveedor</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('proveedor.index') }}">
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
                <form action="{{ route('proveedor.update',$proveedor->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" value="{{ $proveedor->nombre }}" class="form-control" placeholder="Nombre" minlength="1" maxlength="150" pattern="(^(([a-zA-Z0-9. ]+)?$))" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Dirección:</label>
                                <input type="text" name="direccion" value="{{ $proveedor->direccion }}" class="form-control" placeholder="Dirección" minlength="1" maxlength="300" pattern="(^(([a-zA-Z0-9.,\- ]+)?$))" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Teléfono principal:</label>
                                <input type="text" name="fono_1" value="{{ $proveedor->fono_1 }}" class="form-control" placeholder="Teléfono" minlength="7" maxlength="8" pattern="(^((\d){7,8}?$))" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Teléfono secundario:</label>
                                <input type="text" name="fono_2" value="{{ $proveedor->fono_2 }}" class="form-control" placeholder="Teléfono" minlength="7" maxlength="8" pattern="(^((\d){7,8}?$))">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Correo-e:</label>
                                <input type="email" name="correo" value="{{ $proveedor->correo }}" class="form-control" placeholder="Correo-e" minlength="7" maxlength="150">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descrip" class="form-control" rows="3" maxlength="1000">{{ $proveedor->descrip }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    <option value="ACTIVO" @if ($proveedor->estado == 'ACTIVO') selected @endif>ACTIVO</option>
                                    <option value="INACTIVO" @if ($proveedor->estado == 'INACTIVO') selected @endif>INACTIVO</option>
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