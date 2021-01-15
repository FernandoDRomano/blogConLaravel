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
            <p class="login-box-msg">Ingresa tus datos para registrarte</p>

            <form action="{{ route('register') }}" method="POST">
              @csrf

              <div class="input-group mb-3">
                  <input 
                    id="name" 
                    type="text" 
                    class="form-control 
                    @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}"  
                    placeholder="Nombres"
                    autofocus>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
        
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

              <div class="input-group mb-3">
                  <input 
                    id="last_name" 
                    type="text" 
                    class="form-control 
                    @error('last_name') is-invalid @enderror" 
                    name="last_name" 
                    value="{{ old('last_name') }}"  
                    placeholder="Apellidos"
                    autofocus>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
        
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

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

              <div class="input-group mb-3">
                  <input 
                      id="password_confirmation" 
                      type="password" 
                      class="form-control 
                      @error('password_confirmation') is-invalid @enderror" 
                      name="password_confirmation" 
                      placeholder="Repita la contraseña">
                  <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                  </div>
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-blog btn-block text-uppercase">Registrarse</button>
              </div>

            </form>

            <p class="mb-0 text-center">
              <a href="{{ route('login') }}" class="text-black-50">Si ya tienes una cuenta. Ingresa aquí</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

