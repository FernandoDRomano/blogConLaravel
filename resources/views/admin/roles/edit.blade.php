@extends('admin.layout')

@section('title', 'Editar Role')

@section('content')

 

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Editar Role
                </h3>
                <a href="{{ url()->previous() }}" class="d-block link-muted ml-2 text-bold p-0">
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
