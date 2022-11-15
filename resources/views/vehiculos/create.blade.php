@extends('custom.app')

@section('title')
SisAutomotor - Vehículos
@endsection

@section('style_files')
@endsection

@section('style')
@endsection

@section('content')
    @include('vehiculos.head')

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5>Listado de Vehiculos</h5>
                    <a class="btn btn-primary" href="{{ route('vehiculo.create') }}">
                        <i class="fa fa-plus"></i>
                        &nbsp;Nuevo
                    </a>
                </div>
                <div class="card-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur autem voluptatibus aliquid. Ullam, cumque molestias? Voluptate, quo? Blanditiis, unde ipsa. Vel debitis modi alias reprehenderit quos tempore ea fugit eaque?
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_files')
@endsection

@section('script')
@endsection