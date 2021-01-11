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
       No hay permisos para asignar
    @endforelse
</div>