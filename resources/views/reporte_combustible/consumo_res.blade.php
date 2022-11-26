@extends('custom.apprepo')

@section('title')
SisAutomotor - Reportes
@endsection

@section('style_files')
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 text-center">
        <h3>REPORTE DE CONSUMO DE COMBUSTIBLE</h3>
        <h5>DESDE: {{ $fecha_desde }} - HASTA: {{ $fecha_hasta }}</h5>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Combustible</th>
                    <th>Cantidad [litros]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte as $item)
                <tr>
                    <td>{{ $item->combustible }}</td>
                    <td>{{ $item->cantidad }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-3"></div>
</div>

@endsection

@section('script_files')
@endsection

@section('script')
@endsection
