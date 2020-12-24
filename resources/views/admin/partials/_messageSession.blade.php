<script>
    @if (session('message'))
  
        Swal.fire({
              title: '{{ session('title') }}',
              html: '{!! session('message') !!}',
              icon: '{{ session('icon') }}',
              confirmButtonText: 'Cerrar'
        })
  
    @endif

    @if ($errors->any())
        Swal.fire({
              title: 'Error Ups!',
              html: 'Disculpe ocurrio un error, revise por favor.',
              icon: 'error',
              confirmButtonText: 'Cerrar'
        })
    @endif
</script>