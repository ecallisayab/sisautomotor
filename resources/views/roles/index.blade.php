@extends('custom.app')

@section('title')
SisAutomotor - Roles
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
                <h5>Listado de roles</h5>
                @can('role-create')
                <a class="btn btn-primary" href="{{ route('roles.create') }}">
                    <i class="fa fa-plus"></i>
                    &nbsp;Nuevo
                </a>
                @endcan
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table table-bordered table-hover nowrap" style="width:100%" id="dtMain">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>No</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('roles.show',$role->id) }}">Ver</a>
                                @can('role-edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        @endforeach
                        {!! $roles->render() !!}
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
        responsive: true
    });
  });
</script>
@endsection