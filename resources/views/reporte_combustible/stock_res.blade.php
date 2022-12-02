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
        <h3>REPORTE STOCK DE COMBUSTIBLE</h3>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Combustible</th>
                    <th>Cantidad ingresado [litros]</th>
                    <th>Cantidad utilizado [litros]</th>
                    <th>Cantidad actual [litros]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte as $item)
                <tr>
                    <td>{{ $item->combustible }}</td>
                    <td>{{ $item->cantidad_entrada }}</td>
                    <td>{{ $item->cantidad_salida }}</td>
                    <td>{{ $item->stock }}</td>
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
