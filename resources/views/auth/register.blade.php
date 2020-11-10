<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrarse</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('pages.blog') }}"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
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
 
                placeholder="Contraseña">
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
            <button type="submit" class="btn btn-info btn-block text-uppercase">Registrarse</button>
        </div>

      </form>

      <p class="mb-0 text-center">
        <a href="{{ route('login') }}" class="text-black-50">Si ya tienes una cuenta. Ingresa aquí</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.min.js"></script>

</body>
</html>