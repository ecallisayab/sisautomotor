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
                <h5>Mostrar usuario</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('users.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de registro:</strong>
                            {{ $user->id }}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Correo-e:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
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