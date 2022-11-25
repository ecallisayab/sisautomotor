@extends('custom.app')

@section('title')
SisAutomotor - Usuarios
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
                <h5>Listado de usuarios</h5>
                <a class="btn btn-primary" href="{{ route('users.create') }}">
                    <i class="fa fa-plus"></i>
                    &nbsp;Nuevo
                </a>
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
                            <th>Correo-e</th>
                            <th>Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                        <tr>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('users.show',$user->id) }}">Ver</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Editar</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}
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