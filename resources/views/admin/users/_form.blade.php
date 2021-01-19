<div class="row justify-content-center">

    <div class="col-xl-7">

        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="card-title">Datos del Usuario</h5>
            </div>
            <div class="card-body">

                    <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            id="last_name" 
                            value="{{ old('last_name', $user->last_name) }}" 
                            class="form-control"
                            placeholder="Ingrese el apellido del usuario">
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}" 
                            class="form-control" 
                            placeholder="Ingrese el nombre del usuario">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Ingrese el email del usuario">
                    </div>

                    @if (!$user->id)
                        <div class="form-group">
                            <p class="mb-0 text-muted">La contraseña se enviará automaticamente al email ingresado.</p>
                        </div>
                    @endif

            </div>
        </div>

        <div class="card card-info card-outline mb-xl-0">
            <div class="card-header">
                <h5 class="card-title">Roles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($roles as $role)
                        @if ($role->name != 'Subscriber' )
                            <div class="col-12 col-sm-6 col-md-3 col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        <input name="roles[]" type="checkbox" value="{{ $role->name }}"
                                            {{ $user->roles->contains($role->id) || collect( old('roles') )->contains($role->name) ? 'checked': '' }}
                                        > {{ $role->display_name }}
                                    </label>
                                </div>
                                <p class="text-muted small text-black-50">{{$role->description}}</p>
                            </div>
                        @endif
                    @empty
                        <p>No existen roles creados aún.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>{{-- .col-xl-7 --}}

    <div class="col-xl-5">

        <div class="card card-info card-outline h-100">
            <div class="card-header">
                <h5 class="card-title">Permisos Adicionales</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($permissions as $permission)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                            <div class="checkbox">
                                <label>
                                    <input name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                        {{ $user->permissions->contains($permission->id) || collect( old('permissions') )->contains($permission->name) ? 'checked': '' }}
                                    > {{ $permission->display_name }}
                                </label>
                            </div>
                        </div>
                    @empty
                        <p>No existen permisos creados aún.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>{{-- col-xl-5 --}}

   <div class="col-lg-8 mt-3">
        <div class="row">
            <div class="col-md-6 col-xl-8">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Guardar Usuario</button>
            </div>
            <div class="col-md-6 col-xl-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-dark mt-2 mt-md-0 btn-block text-uppercase">Volver</a>
            </div>
        </div>
    </div> {{-- .col-lg-8 botones --}}

</div>{{-- .row --}}