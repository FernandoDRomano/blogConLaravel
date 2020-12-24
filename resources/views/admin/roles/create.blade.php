@extends('admin.layout')

@section('title', 'Nuevo Role')

@section('content')

 

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Nuevo Role
                </h3>
                <a href="{{ route('admin.roles.index') }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    @include('admin.roles._form', ['role' => $role])
                    
                </form>{{-- formulario --}}
            
            </div>{{-- .card-body --}}

        </div>
    </div>
</div>

@endsection
