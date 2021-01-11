@if (current_user()->hasPermissionTo('Update Categories') || current_user()->hasRole('Admin'))
    <a 
        href="{{ route('admin.categories.get', $url) }}" 
        class="btn btn-warning text-white btn-sm"
        onclick="getCategoryEdit(event)">
        <i class="fas fa-edit"></i>
        Editar
    </a>
@endif


@if (current_user()->hasPermissionTo('Delete Categories') || current_user()->hasRole('Admin'))
    <a 
        href="{{ route('admin.categories.get', $url) }}" 
        class="btn btn-danger btn-sm"
        onclick="getCategoryDelete(event)">
        <i class="fas fa-trash-alt"></i>
        ELiminar
    </a>
@endif

