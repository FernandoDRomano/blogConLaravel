@extends('admin.layout')

@section('title', 'Usuario Detalles')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Usuario
                </h3>
                <a href="{{ route('admin.users.index') }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 col-xl-3 mb-3 mb-xl-0">

                        <div class="card card-info card-outline h-100">
                            <div class="card-header">
                                <h5 class="card-title">Datos Personales</h5>
                            </div>
                            <div class="card-body">
                                <div class="profile text-center">
                                    <img src="{{ $user->photo }}" alt="{{$user->getFullName()}}" class="img-fluid rounded-circle border-light" style="height: 150px;">
                                    <h2 class="h5 mt-2 mb-0 font-weight-bold">{{$user->getFullName()}}</h2>
                                    <p class="mb-0 text-black-50">{{ $user->roles->first()->display_name }}</p>
                                </div>

                                <ul class="list-group list-group-unbordered mt-3">
                                    <li class="list-group-item">
                                        <i class="fas fa-at mr-1"></i><strong>Email: </strong> {{$user->email}}
                                    </li>
                                    
                                    @if ($user->hasRole('Admin') || $user->hasRole('Writter'))
                                        <li class="list-group-item">
                                            <i class="fas fa-book mr-1"></i><strong>Posts: </strong> <a href="{{route('admin.posts.index')}}">{{$user->posts->count()}}</a>
                                        </li>
                                    @endif

                                    <li class="list-group-item">
                                        <i class="fas fa-comments mr-1"></i><strong>Comentarios: </strong> {{$user->comments->count()}}
                                    </li>
                                </ul>

                                @can('updateProfile', $user)
                                    <a href="{{route('admin.users.profile.edit', $user)}}" class="btn btn-primary btn-block text-uppercase">Editar Perfil</a>
                                @endcan

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-xl-3 mb-3 mb-xl-0">

                        <div class="card card-info card-outline h-100">
                            <div class="card-header">
                                <h5 class="card-title">Posts</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse ($user->posts->take(5) as $post)
                                            <li class="list-group-item border-top-0 border-right-0 border-left-0">
                                                <p class="font-weight-bold mb-0">
                                                    <i class="fas fa-book mr-1"></i>
                                                    <a href="{{ route('admin.posts.show', $post) }}" class="text-dark" target="_blank">{{ $post->title }}</a>
                                                </p>
                                                <small class="text-muted">
                                                    {{ $post->extract }}
                                                </small>
                                            </li>
                                    @empty
                                        <li class="list-group-item border-0 text-black-50 text-center">
                                            No tiene posts creados.
                                        </li>
                                    @endforelse   
                                </ul>

                                @if ($user->posts->count() > 5)
                                    <a class="d-block lead text-center mt-3" href="{{route('admin.posts.index')}}">Ver todos mis posts</a>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-xl-3 mb-3 mb-xl-0">

                        <div class="card card-info card-outline h-100">
                            <div class="card-header">
                                <h5 class="card-title">Roles</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse ($user->roles as $role)
                                            <li class="list-group-item border-top-0 border-right-0 border-left-0 {{ $loop->last ? 'border-0' : '' }}">
                                                <p class="font-weight-bold mb-0">
                                                    {{ $role->display_name }}
                                                </p>
                                                <small class="text-muted">
                                                    {{ $role->description }}
                                                </small>
                                            </li>
                                    @empty
                                        <li class="list-group-item border-0 text-black-50 text-center">
                                            No tiene roles asignados.
                                        </li>
                                    @endforelse   
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-xl-3 mb-3 mb-xl-0">

                        <div class="card card-info card-outline h-100">
                            <div class="card-header">
                                <h5 class="card-title">Permisos Adicionales</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse ($user->permissions as $permission)
                                            <li class="list-group-item border-top-0 border-right-0 border-left-0 {{ $loop->last ? 'border-0' : '' }}">
                                                <p class="font-weight-bold mb-0">
                                                    {{ $permission->display_name }}
                                                </p>
                                                <small class="text-muted">
                                                    {{ $permission->description }}
                                                </small>
                                            </li>
                                    @empty
                                        <li class="list-group-item border-0 text-black-50 text-center">
                                            No tiene permisos asignados.
                                        </li>
                                    @endforelse   
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection

