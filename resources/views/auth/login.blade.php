@extends('template.app')

@section('content')
<br><br>
<div class="login-box">
    <div class="logo">
        <a>Plataforma<b> "S.E.P.T."</b></a>
        <small>Gestión y administración para proyectos de tesis</small>
    </div>

    <center>
    <img class="img-responsive" style="width:70%" src="images/logo1.png">
    </center>


    <div class="card">
        <div class="body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Correo electrónico" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Contraseña" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-6">
                        <center><button class="btn btn-block bg-red waves-effect" type="submit">{{ __('Ingresar') }}</button></center>
                    </div>
                    <div class="col-xs-3"></div>
                </div>


            <!--   <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div> -->
            </form>
        </div>
    </div>
</div>
@endsection
