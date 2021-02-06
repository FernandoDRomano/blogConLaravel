<div class="d-flex">
    
    @can('update', $user)
        <a 
            href="{{ route('admin.users.edit', $id) }}" 
            class="btn btn-warning text-white btn-sm mx-1">
            <i class="fas fa-edit"></i>
        </a>
        
    @endcan

     @can('delete', $user)
        <a 
            href="{{ route('admin.users.get', $id) }}" 
            class="btn btn-danger btn-sm mx-1"
            onclick="getUserDelete(event)">
            <i class="fas fa-trash-alt"></i>
        </a>   
    @endcan

    @can('view', $user)
        <a href="{{route('admin.users.show', $id)}}"
            class="btn btn-dark btn-sm mx-1">
            <i class="fas fa-eye"></i>
        </a>
    @endcan

    @can('export')                                
        <form action="{{ route('admin.export.user.pdf', $id) }}" method="POST" class="">
            @csrf
            <button class="btn bg-light btn-sm mx-1">
                <i class="fas fa-file-pdf text-danger"></i>
            </button>
        </form>
    @endcan  
    
</div>