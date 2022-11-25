@extends('custom.app')

@section('title')
SisAutomotor - Usuarios
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
                <h5>Editar usuario</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('users.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <label>Advertencia!</label> Hubo algunos problemas con la entrada de datos.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nombre:</label>
                            {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control', 'required' => true)) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Correo-e:</label>
                            {!! Form::text('email', null, array('placeholder' => 'Correo-e','class' => 'form-control', 'required' => true)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Contraseña:</label>
                            {!! Form::password('password', array('placeholder' => 'Contraseña','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Confirmar contraseña:</label>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirmar contraseña','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Role (una o varias opciones):</label>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple', 'required' => true)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_files')
@endsection

@section('script')
@endsection