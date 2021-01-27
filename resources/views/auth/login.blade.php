@extends('layout')

@section('title')
    Ingresar
@endsection

@section('content')

<div class="container">
  <div class="row mb-5 justify-content-center align-items-center">
    <div class="col-auto">
      
      <div class="login-box">
        <div class="card">
          <div class="card-body login-card-body">

            <p class="text-center text-black-50">Inicia Sesión con</p>
            <div class="d-flex justify-content-around text-center">
              <a href="{{route('login.social', 'facebook')}}" class="btn btn-facebook">
                <i class="fab fa-facebook-f"></i> Facebook
              </a>

              <a href="{{route('login.social', 'google')}}" class="btn btn-google">
                <i class="fab fa-google"></i> Google
              </a>

              <a href="{{route('login.social', 'github')}}" class="btn btn-github">
                <i class="fab fa-github"></i> Github
              </a>
            </div>
            
            <hr>

            <p class="text-black-50 text-center">O ingresa tus credenciales para ingresar</p>

            <form action="{{ route('login') }}" method="POST">
              @csrf

              <div class="input-group mb-3">
                <input 
                  id="email" 
                  type="email" 
                  class="form-control 
                  @error('email') is-invalid @enderror" 
                  name="email" 
                  value="{{ old('email') }}"  
                  placeholder="Email"
                  autocomplete="email" 
                  autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>


              <div class="input-group mb-3">
                  <input 
                      id="password" 
                      type="password" 
                      class="form-control 
                      @error('password') is-invalid @enderror" 
                      name="password" 
      
                      placeholder="Contraseña">
                  <div class="input-group-append">
                      <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                      </div>
                </div>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-blog btn-block text-uppercase">Ingresar</button>
              </div>

            </form>

            <p class="mb-0 text-center">
              <a href="{{ route('register') }}" class="text-black-50">Si no tienes una cuenta. Registrate aquí</a>
            </p>
            <p class="mb-0 text-center">
              <a href="{{ route('password.request') }}" class="text-black-50">¿Olvidaste tu contraseña?</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
      <!-- /.login-box -->

    </div>
  </div>
</div>

@endsection

