@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <h5 class="text-uppercase">Existén errores en los datos enviados, revise por favor.</h5>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif