@forelse ($model->tags as $tag)
    <p class="d-inline lead"><span class="badge badge-pill badge-info">{{$tag->name}}</span></p>
@empty
    <p class="lead"><span class="badge badge-pill badge-light">No tiene Etiquetas</span></p>
@endforelse