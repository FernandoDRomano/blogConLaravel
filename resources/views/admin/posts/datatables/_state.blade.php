@if ($model->approved)
    <p class="lead d-inline"><span class="badge badge-pill badge-success">Aprobado</span></p>
@else
    <p class="lead"><span class="badge badge-pill badge-secondary">Falta aprobar</span></p>
@endif