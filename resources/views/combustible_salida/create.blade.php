@extends('custom.app')

@section('title')
SisAutomotor - Salidas de Combustible
@endsection

@section('style_files')
@endsection

@section('style')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5>Nueva salida de combustible</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('combustible_salida.index') }}">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;Atrás
                </a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Advertencia!</strong> Hubo algunos problemas con la entrada de datos.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('combustible_salida.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" name="fecha" class="form-control" placeholder="Fecha" min="{{ date('Y-m-d',time()-(86400*1)) }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Combustible:</label>
                                <select name="id_combustible" class="form-control" id="cboIdCombustible" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($combustibles as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cantidad:</label>
                                <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" min="0" max="" step="any" id="txtCantidad" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. de transportes:</label>
                                <select name="id_empleado" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($empleados as $item)
                                    <option value="{{ $item->id }}">{{ $item->empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vehículo:</label>
                                <select name="id_vehiculo" class="form-control" required>
                                    <option value="">--Seleccione una opción--</option>
                                    @foreach ($vehiculos as $item)
                                    <option value="{{ $item->id }}">{{ $item->marca.' '.$item->modelo.' ['.$item->matricula.']' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Resp. vehículo:</label>
                                <input type="text" name="resp_vehiculo" class="form-control" placeholder="Emp. proveedor" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Observación:</label>
                                <textarea class="form-control" name="obs" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_files')
@endsection

@section('script')
<script type="text/javascript">
  $(function () {
    var stockCombustible = <?php echo $combustible_stock; ?>;

    $("#cboIdCombustible").on("change", function() {
        var stock = stockCombustible[$(this).val()];
        if (stock === 0) {
            $("#txtCantidad").attr("min", 0);
        } else {
            $("#txtCantidad").attr("min", 1);
        }
        $("#txtCantidad").attr("max", stock);
    });
  });
</script>
@endsection