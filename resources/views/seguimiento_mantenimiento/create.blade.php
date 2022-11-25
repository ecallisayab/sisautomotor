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
                <strong>MANTENIMIENTO N°: {{ $id_mantenimiento }}</strong> 
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Nuevo seguimiento</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('seguimiento_mantenimiento.index', $id_mantenimiento) }}">
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

                <form action="{{ route('seguimiento_mantenimiento.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_mantenimiento" value="{{ $id_mantenimiento }}">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" class="form-control" placeholder="Fecha" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}">{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descrip" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3"></textarea>
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