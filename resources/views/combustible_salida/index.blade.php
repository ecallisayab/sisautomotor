@extends('custom.app')

@section('title')
SisAutomotor - Salidas de Combustible
@endsection

@section('style_files')
<link href="{{ asset('custom/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Listado de salidas de combustible</h5>
                @can('combustible_salida-create')
                <a class="btn btn-primary" href="{{ route('combustible_salida.create') }}">
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

                <table class="table table-bordered table-hover user_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y hora</th>
                            <th>Combustible</th>
                            <th>Cantidad</th>
                            <th>Responsable transportes</th>
                            <th>Vehículo</th>
                            <th>Resp. vehículo</th>
                            <th>Obs.</th>
                            <th>Acciones</th>
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
@endsection

@section('script')
<script type="text/javascript">
  $(function () {
    var table = $('.user_datatable').DataTable({
        language: {
            url: "{{ asset('custom/vendor/datatables/datatables.es.json') }}"
        },
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: "{{ route('combustible_salida.getList') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fecha_hora', name: 'fecha_hora'},
            {data: 'combustible', name: 'combustible'},
            {data: 'cantidad', name: 'cantidad'},
            {data: 'empleado', name: 'empleado'},
            {data: 'vehiculo', name: 'vehiculo'},
            {data: 'resp_vehiculo', name: 'resp_vehiculo'},
            {data: 'obs', name: 'obs'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endsection