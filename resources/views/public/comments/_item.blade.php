@if ($comment->approved)

    <div class="row w-100 align-items-center my-3 {{ $margin }} rounded">

        <div class="col-2 h-100 text-center">
            <img src="{{ $comment->user->photo }}" alt="" class="img-fluid rounded-circle d-block mx-auto" style="height: 85px; width: 85px;">
        </div>
        <div class="col-10 h-100 px-0">
            <div class="comment border p-3">
                <div class="d-flex justify-content-between">
                    <small class="font-weight-bolder">{{ $comment->user->getFullName() }}</small>
                    <small class="text-black-50">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="text-black-50 small mb-0">{{ $comment->body }}</p>
            </div>
        </div>
        
        @auth
            @can('create', $comment)
                <div class="col-12 px-0">
                    <a href="{{ route('admin.comments.get', $comment) }}" class="btn btn-outline-dark btn-sm mt-2 float-right" onclick="getCommentResponse(event)">
                        Responder
                    </a>
                </div>
            @endcan
        @endauth

        @if ($comment->childs)
            @include('public.comments._list', ['comments' => $comment->childs, 'margin' => 'ml-5'])
        @endif
    </div> 

@else

    <div class="row w-100 align-items-center my-3 {{ $margin }} rounded">

        <div class="col-2 h-100 text-center">
            <img src="{{ $comment->user->photo }}" alt="" class="img-fluid rounded-circle d-block mx-auto" style="height: 85px; width: 85px;">
        </div>
        <div class="col-10 h-100 px-0 bg-blue">
            <div class="comment border p-3">
                <div class="d-flex justify-content-between">
                    <small class="font-weight-bolder">{{ $comment->user->getFullName() }}</small>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="small mb-0">Tu comentario pronto sera revisado por nuestros moderadores</p>
            </div>
        </div>
        
    </div> 

@endif



