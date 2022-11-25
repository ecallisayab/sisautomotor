@extends('custom.app')

@section('title')
SisAutomotor - Mantenimiento
@endsection

@section('style_files')
<link href="{{ asset('custom/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('custom/vendor/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Listado de mantenimiento</h5>
                @can('mantenimiento_entrada-create')
                <a class="btn btn-primary" href="{{ route('mantenimiento_entrada.create') }}">
                    <i class="fa fa-plus"></i>
                    &nbsp;Nuevo
                </a>
                @endcan
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
                @elseif (Session::get('warning'))
                <div class="alert alert-warning">
                    <p>{{ Session::get('warning') }}</p>
                </div>
                @endif

                <table class="table table-bordered table-hover nowrap" style="width:100%" id="dtMain">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID</th>
                            <th>Tipo de mantenimiento</th>
                            <th>Vehículo</th>
                            <th>Diagnóstico</th>
                            <th>Fecha y hora de entrada</th>
                            <th>Fecha y hora de salida</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_files')
<script src="{{ asset('custom/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('custom/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('custom/vendor/datatables/dataTables.responsive.min.js') }}"></script>
@endsection

@section('script')
<script type="text/javascript">
  $(function () {
    var table = $('#dtMain').DataTable({
        language: {
            url: "{{ asset('custom/vendor/datatables/datatables.es.json') }}"
        },
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: "{{ route('mantenimiento.getList') }}",
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'tipo_mantenimiento', name: 'tipo_mantenimiento'},
            {data: 'vehiculo', name: 'vehiculo'},
            {data: 'diagnostico_entrada', name: 'diagnostico_entrada'},
            {data: 'fecha_hora_entrada', name: 'fecha_hora_entrada'},
            {data: 'fecha_hora_salida', name: 'fecha_hora_salida'},
            {data: 'estado', name: 'estado'}
        ]
    });
  });
</script>
@endsection