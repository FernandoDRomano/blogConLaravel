<p class="text-center lead font-weight-bold text-black-50">Los permisos del Role {{$role->name}} no se pueden editar, debido a que es un role definido por el Sistema</p>

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