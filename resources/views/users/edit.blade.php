@extends('custom.app')

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
                    <strong>Advertencia!</strong> Hubo algunos problemas con la entrada de datos.<br><br>
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
                            <strong>Nombre:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control', 'required' => true)) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <strong>Correo-e:</strong>
                            {!! Form::text('email', null, array('placeholder' => 'Correo-e','class' => 'form-control', 'required' => true)) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <strong>Contraseña:</strong>
                            {!! Form::password('password', array('placeholder' => 'Contraseña','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <strong>Confirmar contraseña:</strong>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirmar contraseña','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <strong>Role (una o varias opciones):</strong>
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