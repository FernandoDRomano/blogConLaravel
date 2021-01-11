@extends('admin.layout')

@section('title', 'Role: ' . $role->display_name)

@push('links')
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Información del Role " . $role->display_name])
@endsection

@push('style')
    <style>
        .contenedor{
            width: 100%;
            height: 100%;
            background-color: grey;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-template-rows: auto;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-row card-info">

                <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title lea mr-2 d-block">
                    Role: {{ $role->display_name }}
                    </h3>
                    <a href="{{ route('admin.roles.index') }}" class="d-block link-muted ml-2 text-bold p-0">
                        <i class="fas fa-reply"></i>
                        Volver
                    </a>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-xl-4 mb-3 mb-xl-0">
                            <div class="card card-info card-outline h-100">
                                <div class="card-header">
                                    <h5 class="card-title">Información</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Identificador: </strong>{{ $role->name }}</p>
                                    <p><strong>Nombre: </strong>{{$role->display_name}}</p>
                                    <p><strong>Descripción: </strong>{{$role->description}}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-xl-8">
                            <div class="card card-info card-outline h-100">
                                <div class="card-header">
                                    <h5 class="card-title">Permisos</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @forelse ($role->permissions as $permission)
                                            <li class="list-group-item list-group-item-info py-2 font-weight-bold small">
                                                {{$permission->display_name}}
                                                <span class="text-muted">{{ $permission->description }}</span>
                                            </li>
                                        @empty
                                            <li class="list-group-item list-group-item-info py-2 font-weight-bold small">
                                                No hay permisos asignados para este Role
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card card-info card-outline h-100">
                                <div class="card-header">
                                    <h5 class="card-title">Usuarios</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse ($role->users as $user)
                                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 text-center font-weight-bolder mb-2">
                                                <img 
                                                    class="img-fluid rounded-circle"
                                                    style="height: 120px;"
                                                    src="{{ $user->photo }}" 
                                                    alt="{{ $user->name }}">
                                                <p>
                                                    <a href="{{ route('admin.users.show', $user) }}" class="font-weight-bolder text-black-50">
                                                        {{ $user->getFullName() }}
                                                    </a>
                                                </p>
                                            </div>
                                        @empty
                                            <p>No existen usuarios asignado a este Role</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- .card-body --}}

            </div>
        </div>
    </div>
@endsection