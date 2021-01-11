@extends('admin.layout')

@section('title', 'Administración')
    
@section('content')

    <div class="row mb-3 justify-content-center">

        <div class="col-12 mb-3">
            <h1 class="text-center font-weight-bold text-black-50 mt-3">Bienvenido {{ current_user()->getFullName() }}</h1>    
        </div>

            @can('view', $user)
                <div class="mb-3 col-12 {{ columns_for_dashboard() }}">
                    <div class="card card-info card-outline h-100">
                        <div class="card-header">
                            <h5 class="card-title">Ultimos Usuarios</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($users as $user)
                                    <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 text-center font-weight-bolder mb-2">
                                        <img 
                                            class="img-fluid rounded-circle"
                                            style="height: 80px;"
                                            src="{{ $user->photo }}" 
                                            alt="{{ $user->name }}">
                                        <p>
                                            <a href="{{ route('admin.users.show', $user) }}" class="font-weight-bolder text-black-50">
                                                {{ $user->getFullName() }}
                                            </a>
                                        </p>
                                    </div>
                                @empty
                                    <p>No existen usuarios</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('view', $post)
                <div class="mb-3 col-12 {{ columns_for_dashboard() }} ">
                    <div class="card card-info card-outline h-100">
                        <div class="card-header">
                            <h5 class="card-title">Ultimos Posts</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($posts as $post)
                                    <div class="list-group w-100">
                                        <a href="{{route('admin.posts.show', $post)}}" class="list-group-item list-group-item-action flex-column align-items-start" target="_blank">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 font-weight-bold">{{ $post->title }}</h5>
                                                <small>{{ $post->published_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{{ Str::limit($post->extract, 40, '...') }}</p>
                                            <span class="badge badge-pill bg-maroon">{{$post->user->getFullName()}}</span>
                                        </a>
                                    </div>
                                @empty
                                    <p>No existen Posts creados aún</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            
            @can('view', $comment)
                <div class="mb-3 col-12 {{ columns_for_dashboard() }}">
                    <div class="card card-info card-outline h-100">
                        <div class="card-header">
                            <h5 class="card-title">Ultimos Comentarios</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($comments as $comment)
                                    <div class="list-group w-100">
                                        <a href="{{route('admin.comments.index')}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 font-weight-bold">{{ $comment->user->getFullName() }}</h5>
                                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 small">{{ Str::limit($comment->body, 40, '...') }}</p>
                                            @if ($comment->approved)
                                                <span class="badge badge-pill badge-info">Aprobado</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">No Aprobado</span>
                                            @endif
                                        </a>
                                    </div>
                                @empty
                                    <p>No existen Posts creados aún</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

    </div>  
@endsection