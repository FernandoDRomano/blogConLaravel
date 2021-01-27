@extends('layout')

@section('title', 'Reestablecer Contraseña')

@section('content')
<div class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-body login-card-body">

                    <p class="text-black-50 text-center">Ingresar tu Email para reestablecer la contraseña</p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">

                            <input 
                                id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
                                placeholder="Email" 
                                autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-blog btn-block text-uppercase">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
