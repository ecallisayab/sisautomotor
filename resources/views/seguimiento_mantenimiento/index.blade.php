@extends('custom.app')

@section('title')
SisAutomotor - Seguimiento a mantenimiento
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
            <div class="card-body alert-primary">
                <strong>MANTENIMIENTO N°: {{ $id_mantenimiento }}</strong>
                <a class="btn btn-secondary btn-sm" href="{{ route('mantenimiento.index') }}" style="float: right;">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Listado de seguimiento</h5>
                @can('seg_mantenimiento-create')
                <a class="btn btn-primary" href="{{ route('seguimiento_mantenimiento.create', $id_mantenimiento) }}">
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
                            <th>Fecha y hora</th>
                            <th>Descripción</th>
                            <th>Resp. de transportes</th>
                            <th>Observación</th>
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
        ajax: "{{ route('seguimiento_mantenimiento.getList', $id_mantenimiento) }}",
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'fecha_hora', name: 'fecha_hora'},
            {data: 'descrip', name: 'descrip'},
            {data: 'empleado', name: 'empleado'},
            {data: 'obs', name: 'obs'}
        ]
    });
  });
</script>
@endsection