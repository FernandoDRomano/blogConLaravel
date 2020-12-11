@extends('admin.layout')

@section('title', 'Edición de Permiso')

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
    <div class="col-lg-6 mt-3">

        <div class="card card-row card-info">
            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Editar Permiso
                </h3>
                <a href="{{ route('admin.permissions.index') }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>
            <div class="card-body">
                
                <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Identificador</label>
                        <input type="text" 
                                name="name" 
                                id="name" 
                                value="{{ $permission->name }}" 
                                class="form-control" 
                                disabled>
                    </div>

                    <div class="form-group">
                        <label for="display_name">Nombre</label>
                        <input type="text" 
                                name="display_name" 
                                id="display_name" 
                                value="{{ old('display_name', $permission->display_name) }}" 
                                class="form-control" 
                                placeholder="Ingrese el nombre del permiso">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="5" 
                            class="form-control">{{ old('description', $permission->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-8 col-xl-9">
                                <button type="submit" class="btn btn-primary btn-block text-uppercase">Actualizar Permiso</button>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-dark mt-2 mt-lg-0 btn-block text-uppercase">Volver</a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    
    
    </div>
</div>

@endsection
