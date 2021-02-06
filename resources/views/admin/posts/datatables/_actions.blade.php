<div class="d-flex">
    @can('update', $post)
        <a 
            href="{{ route('admin.posts.edit', $url) }}" 
            class="btn btn-warning text-white btn-sm mx-1">
            <i class="fas fa-edit"></i>
        </a>     
    @endcan

    @can('delete', $post)    
        <a 
            href="{{ route('admin.posts.get', $url) }}" 
            class="btn btn-danger btn-sm mx-1"
            onclick="getPostDelete(event)">
            <i class="fas fa-trash-alt"></i>
        </a>    
    @endcan

    @can('show', $post)
        <a href="{{route('admin.posts.show', $url)}}"
            target="_blank"
            style="background-color: #3c8dbc"
            class="btn text-white btn-sm mx-1">
            <i class="fas fa-eye"></i>
        </a>
    @endcan

    @can('update-approved', $post)    
        @if ($model->approved)
            <a 
                href="{{ route('admin.posts.get', $url) }}" 
                onclick="updatePostApproved(event)" 
                class="btn btn-sm mx-1 text-white" style="background-color: #111111">
                <i class="fas fa-times-circle"></i>    
            </a>
        @else
            <a 
                href="{{ route('admin.posts.get', $url) }}" 
                onclick="updatePostApproved(event)" 
                class="btn btn-sm mx-1 text-white" style="background-color: #605ca8">
                <i class="fas fa-check-circle"></i>
            </a>
        @endif
    @endcan

</div>