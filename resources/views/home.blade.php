@extends('custom.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Municipio Santiago de Huata</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 50rem;" src="{{ asset('custom/img/municipio_santiago_huata.jpg') }}" alt="...">
                </div>
                <p>Santiago de Huata es un pueblo y municipio de Bolivia, ubicado a orillas del lago Titicaca, dentro de la provincia de Omasuyos en el departamento de La Paz. Geográficamente conforma una región y península al este del lago Titicaca.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Acerca de SIS.AUTOMOTOR</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 50rem;" src="{{ asset('custom/img/maquinaria_pesada.jpg') }}" alt="...">
                </div>
                <p>El sistema de control y seguimiento del parque automotor (SIS.AUTOMOTOR), permitirá manejar de manera más eficiente el recurso combustible, ayudando a controlar su uso y disponibilidad. Asimismo, ayudará a controlar el mantenimiento de los vehículos existentes, para que estén funcionales y operativos.</p>
            </div>
        </div>
    </div>
</div>
@endsection
