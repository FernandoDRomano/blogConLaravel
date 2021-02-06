@if ($model->category)
    <p class="d-inline lead"><span class="badge badge-pill badge-primary">{{$model->category->name}}</span></p>
@else
    <p class="lead"><span class="badge badge-pill badge-light">No tiene Categoría</span></p>
@endif