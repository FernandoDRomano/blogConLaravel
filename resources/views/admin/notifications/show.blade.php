@extends('admin.layout')

@section('title', 'Notificaciones')

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Notificación"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Notificación</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 font-weight-bold">
                        {{ $notification->data['title'] }} 
                    </h5>
                    <small class="text-black-50">{{$notification->created_at->diffForHumans()}}</small>
                </div>
                <p class="mb-2">{{ $notification->data['text'] }}</p>
                <div class="d-flex flex-row-reverse justify-content-between">

                    <form action="{{route('admin.notifications.destroy', $notification)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button href="#" class="btn btn-danger btn-sm ">Eliminar</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- /.card-body -->
  </div>

@endsection
