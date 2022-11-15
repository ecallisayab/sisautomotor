@extends('custom.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Nuevo usuario</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('users.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Advertencia!</strong> Hubo algunos problemas con la entrada de datos.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name"  required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Correo-e:</label>
                                <input type="email" class="form-control" placeholder="Correo-e" name="email"  required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="password"  required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Confirmar contraseña:</label>
                                <input type="password" class="form-control" placeholder="Confirmar contraseña" name="confirm-password"  required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Rol (una o varias opciones):</label>
                                <select class="form-control" name="roles[]" required multiple>
                                    @foreach ($roles as $indice => $item)
                                    <option value="{{ $indice }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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