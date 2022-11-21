@extends('custom.app')

@section('title')
SisAutomotor - Entradas Vehiculos
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
                <h5>Listado de entradas de Vehiculos</h5>
                @can('vehiculo_entrada-create')
                <a class="btn btn-primary" href="{{ route('vehiculo_entrada.create') }}">
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
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Vehiculo</th>
                            <th>Empleado</th>
                            <th>Responsable de Vehiculo</th>
                            <th>Obs.</th>
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
        ajax: "{{ route('vehiculo_entrada.getList') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fecha', name: 'fecha'},
            {data: 'hora', name: 'hora'},
            {data: 'vehiculo', name: 'vehiculo'},
            {data: 'empleado', name: 'empleado'},
            {data: 'resp_vehiculo', name: 'resp_vehiculo'},
            {data: 'obs', name: 'obs'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endsection