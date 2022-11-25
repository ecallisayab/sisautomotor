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
        <h3>REPORTE DE ENTRADAS DE COMBUSTIBLE</h3>
        <h5>DESDE: {{ $fecha_desde }} - HASTA: {{ $fecha_hasta }}</h5>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N° ENTRADA</th>
                    <th>Fecha y hora</th>
                    <th>Combustible</th>
                    <th>Cantidad [litros]</th>
                    <th>Proveedor</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->fecha_hora }}</td>
                    <td>{{ $item->combustible }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->proveedor }}</td>
                    <td>{{ $item->obs }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script_files')
@endsection

@section('script')
@endsection
