@extends('custom.applogin')

@section('title')
SisAutomotor - Login
@endsection

@section('style_files')
@endsection

@section('style')
<style>
body {
    background-image: radial-gradient(circle at 49.04% 49.33%, #b1dfff 0, #38a5ff 50%, #006fe6 100%);
}

.card {
    background-color: rgb(0, 0, 0, 0.0);
    margin: auto;
    position: absolute;
    top: 0; left: 0; bottom: 0; right: 0;     
}
</style>
@endsection

@section('content')
<div class="container-fluid h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
            <div class="card">
                <div class="row g-0">
                <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4" style="margin: 10%">
                            <div class="text-center">
                                <img src="{{ asset('custom/img/logo.png') }}" style="width: 130px;" alt="logo">
                                <h4 class="mt-1 mb-5 pb-1">SisAutomotor</h4>
                            </div>
                            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                @csrf
                                <div class="form-outline mb-4">
                                    <!-- <label class="form-label" for="form2Example11">Correo electrónico</label> -->
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name='email' placeholder="Correo electrónico" required autofocus>          
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <!-- <label class="form-label" for="form2Example22">Contraseña</label> -->
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name='password' placeholder="Contraseña" required>     
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block" type="submit">Ingresar al sistema</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
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
    
  });
</script>
@endsection