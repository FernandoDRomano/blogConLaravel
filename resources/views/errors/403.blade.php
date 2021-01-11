@extends('layout')

@section('title', 'Página 403: Acción no autorizada')

@push('style')
    <style>
        .display-2{
            font-size: 3rem;
        }

        .text-black-50{
            color: rgba(0, 0, 0, .5);
        }

        .lead{
            font-size: 1.2rem;
        }

        .flex{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .h-100{
            min-height: 25rem;
        }

    </style>
@endpush

@section('content')
    
    <div class="flex h-100">
        <h1 class="display-2 text-black-50">403 | Acción no Autorizada</h1>
        <p class="lead">
            Lo sentimos, no tienes permiso para realizar esta acción
            <a href="{{ url()->previous() }}">volver</a>
        </p>
    </div>

@endsection