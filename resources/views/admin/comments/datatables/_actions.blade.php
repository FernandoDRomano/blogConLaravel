@can('delete', $comment)
        <a 
            href="{{ route('admin.comments.get', $id) }}" 
            class="btn btn-danger btn-sm mb-1"
            onclick="getCommentDelete(event)">
            <i class="fas fa-trash-alt"></i>
        </a>    
@endcan

@can('view', $comment)
        <a href="{{ route('admin.comments.get', $id) }}"
            style="background-color: #3c8dbc"
            onclick="getCommentShow(event)"
            class="btn text-white btn-sm mb-1">
            <i class="fas fa-eye"></i>
        </a>
@endcan

@can('update', $comment)
    @if ($comment->approved)
            <a 
                href="{{ route('admin.comments.get', $id) }}" 
                onclick="updateCommentApproved(event)" 
                class="btn btn-sm text-white mb-1" style="background-color: #111111">
                <i class="fas fa-times-circle"></i>    
            </a>
    @else
            <a 
                href="{{ route('admin.comments.get', $id) }}" 
                onclick="updateCommentApproved(event)" 
                class="btn btn-sm text-white mb-1" style="background-color: #605ca8">
                <i class="fas fa-check-circle"></i>
            </a>
    @endif
@endcan 