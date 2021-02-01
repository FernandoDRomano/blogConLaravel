@extends('admin.layout')

@section('title', 'Notificaciones')

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Notificaciones"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-md-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Notificaciones</h3>
                <div class="d-flex">
                    <form action="{{ route('admin.notifications.readAll') }}" method="POST" class="pr-2">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-block btn-info text-uppercase">
                            <i class="fas fa-check-double"></i>
                            Marcar todas como leídas
                        </button>
                    </form>
                    <form action="{{ route('admin.notifications.destroyAll') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-block btn-danger text-uppercase">
                            <i class="fas fa-trash"></i>
                            Eliminar Todas
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="list-group">

                @forelse ($notifications as $notification)
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 font-weight-bold">
                                {{ $notification->data['title'] }} 
                                <span class="badge {{ $notification->read_at ? 'bg-success' : 'bg-warning' }}">{{ $notification->read_at ? 'Leída' : 'No leída' }}</span>
                            </h5>
                            <small class="text-black-50">{{$notification->created_at->diffForHumans()}}</small>
                        </div>
                        <p class="mb-2">{!! $notification->data['text'] !!}</p>
                        <div class="d-flex flex-row-reverse justify-content-between">

                            <form action="{{route('admin.notifications.destroy', $notification)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button href="#" class="btn btn-danger btn-sm ">Eliminar</button>
                            </form>

                            @if (!$notification->read_at)
                                <form action="{{route('admin.notifications.update', $notification)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button href="#" class="btn btn-success btn-sm">Marcar como leída</button>
                                </form>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">No tienes notificaciones</h5>
                        </div>
                    </div>
                @endforelse
                

              </div>
        </div>
        <!-- /.card-body -->
  </div>

@endsection
