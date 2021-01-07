<form action="{{route('admin.comments.store')}}" method="POST">
    @csrf
    <div class="row w-75 align-items-center">
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="col-2 h-100">
            <img src="{{ auth()->user()->photo }}" alt="" class="img-fluid rounded-circle" style="height: 75px; width: 75px;">
        </div>
        <div class="col-9 h-100 px-0">
            <div class="form-group mb-0">
                <textarea name="body" id="body" cols="30" rows="4" class="form-control" placeholder="Ingresa tu comentario" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="col-11 mt-2 px-0">
            <button class="btn text-uppercase btn-primary float-right">Comentar</button>
        </div>
    </div>
</form>