<script>

    @if (session('message'))
  
        Swal.fire({
              title: '{{ session('title') }}',
              html: `{!! session('message') !!}`,
              icon: '{{ session('icon') }}',
              confirmButtonText: 'Cerrar'
        })
  
    @endif

    @if ($errors->any())
        let template = '';
        @foreach($errors->all() as $message)
            template += '<p class="text-danger">{{$message}}</p>'
        @endforeach

        console.log(template);

        Swal.fire({
              title: 'Error Ups!',
              html: `
                Disculpe ocurrio un error, revise por favor.
                ${template}
              `,
              icon: 'error',
              confirmButtonText: 'Cerrar'
        })
    @endif

</script>