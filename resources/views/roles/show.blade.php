@extends('custom.app')

@section('title')
SisAutomotor - Roles
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
                <h5>Mostrar rol</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('roles.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>N° de registro:</strong>
                            {{ $role->id }}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <strong>Permisos:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <label class="label label-success">{{ $v->name }}&nbsp;&nbsp;</label>
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