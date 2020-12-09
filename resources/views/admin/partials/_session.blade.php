@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <p class="mb-0 text-uppercase"> <strong> {{session('message')}} </strong> </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif