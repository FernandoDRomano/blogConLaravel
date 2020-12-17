<div class="row justify-content-center">

    <div class="col-xl-5">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="card-title">Datos del Role</h5>
            </div>
            <div class="card-body">

                    <div class="form-group">
                        <label for="name">Identificador</label>
                        @if ($role->name)
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ $role->name }}" 
                                class="form-control"
                                disabled
                                placeholder="Ingrese el identificador para el role">
                        @else
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $role->name) }}" 
                                class="form-control"
                                placeholder="Ingrese el identificador para el role">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="display_name">Nombre</label>
                        <input type="text" 
                                name="display_name" 
                                id="display_name" 
                                value="{{ old('display_name', $role->display_name) }}" 
                                class="form-control" 
                                placeholder="Ingrese el nombre del role">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="2" 
                            class="form-control"
                            placeholder="Ingrese la descripción del role">{{ old('description', $role->description) }}</textarea>
                    </div>

            </div>
        </div>
    </div>{{-- .col-xl-5 --}}

    <div class="col-xl-7">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="card-title">Permisos del Role</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($permissions as $permission)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="checkbox">
                                <label>
                                    <input name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                        {{ $role->permissions->contains($permission->id) || collect( old('permissions') )->contains($permission->name) ? 'checked': '' }}
                                    > {{ $permission->display_name }}
                                </label>
                            </div>
                        </div>
                    @empty
                        no hay nada
                    @endforelse
                </div>
            </div>
        </div>
    </div>{{-- col-xl-7 --}}

    <div class="col-lg-8">
        <div class="row">
            <div class="col-md-6 col-xl-8">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Guardar Role</button>
            </div>
            <div class="col-md-6 col-xl-4">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark mt-2 mt-md-0 btn-block text-uppercase">Volver</a>
            </div>
        </div>
    </div>{{-- .col-lg-8 botones --}}

</div>{{-- .row --}}