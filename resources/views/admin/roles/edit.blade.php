@extends('admin.layout')

@section('title', 'Editar Role')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <h5 class="text-uppercase">Existén errores en los datos enviados, revise por favor.</h5>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Editar Role
                </h3>
                <a href="{{ route('admin.roles.index') }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @include('admin.roles._form', ['role' => $role])
                    
                </form>{{-- formulario --}}
            
            </div>{{-- .card-body --}}

        </div>
    </div>
</div>

@endsection
