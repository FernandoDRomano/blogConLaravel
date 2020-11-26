<a 
    href="{{ route('admin.tags.get', $url) }}" 
    class="btn btn-warning text-white btn-sm"
    onclick="getTagEdit(event)">
    <i class="fas fa-edit"></i>
    Editar
</a>

<a 
    href="{{ route('admin.tags.get', $url) }}" 
    class="btn btn-danger btn-sm"
    onclick="getTagDelete(event)">
    <i class="fas fa-trash-alt"></i>
    ELiminar
</a>
