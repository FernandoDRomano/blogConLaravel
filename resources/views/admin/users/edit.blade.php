@extends('admin.layout')

@section('title', 'Editar Usuario')

@section('content')

 

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Editar Usuario
                </h3>
                <a href="{{ url()->previous() }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @include('admin.users._form', ['user' => $user])
                    
                </form>{{-- formulario --}}
            
            </div>{{-- .card-body --}}

        </div>
    </div>
</div>

@endsection

