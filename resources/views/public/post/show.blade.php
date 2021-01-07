@extends('layout')

@section('title', $post->title)

@section('content')

@push('style')
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/css/adminlte.min.css">
@endpush

<section class="pages container mb-5">

    @includeIf($post->typeViewImageOrCarousel(), ["post" => $post,  "marginNegative" => "margin-negative"])

    <div class="page page-about post py-5">

        @if ($post->category)
            <header class="container-flex space-between">
                <div class="post-category">
                    <a href="{{ route('pages.category.show.posts', $post->category) }}" class="category text-capitalize">{{ $post->category->name }}</a>
                </div>
            </header>
        @endif

        <h1 class="text-capitalize">{{$post->title}}</h1>
        <cite>{{$post->extract}}</cite>

        <div class="date">
            <span class="c-gray-1 small">{{$post->published_at ? $post->published_at->diffForHumans() : null}}</span>
        </div>

        @if ($post->iframe)
            @include('public.post._iframe', ["iframe" => $post->iframe])
        @endif

        <div class="divider-2" style="margin: 35px 0;"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>
    </div>

    <section class="mt-5 pl-5">
        <h4 class="font-weight-bold text-black-50 h2">Comentarios</h4>

        <hr>

        @auth
            @can('create', $comment)
                @include('public.comments._form')
            @else
                <h4 class="font-weight-bold">No tienes permisos para comentar aún</h4>
            @endcan
        @endauth

        @include('public.comments._list', ['comments' => $comments, 'margin' => ''])
    </section>

    <form action="{{ route('admin.comments.store', $post) }}" method="POST" id="form-response" class="d-none">
        @csrf
        <input type="hidden" name="body" id="form_response_body">
        <input type="hidden" name="post_id" id="post_id">
        <input type="hidden" name="parent_comment_id" id="form_response_parent_comment_id">
    </form>

</section>

@endsection

@push('script')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        $('.carousel').carousel({
            interval: 2000
        })

        let formResponse = document.getElementById('form-response')

        async function getCommentResponse(e) {
            e.preventDefault();
            try {
                const comment = await getComment(e);
                               
                showModalResponseComment(comment);

            } catch (error) {
                console.log(error)
            }
        }

        function showModalResponseComment(comment){

            Swal.fire({
                
                title: 'Responder Comentario',
                html: `
                        <p class="">Estas por responderle el comentario de <strong>${comment.user.last_name}, ${comment.user.name}</strong></p>
                        <small class="text-black-50 mt-3">${comment.body}</small>
                    `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Comentar',
                cancelButtonText: 'Cerrar',
                buttonsStyling:false,
                customClass: {
                    confirmButton: 'btn btn-danger text-white mr-2',
                    cancelButton: 'btn btn-outline-secondary'
                },
                input: 'textarea',
                inputPlaceholder: 'Ingrese su comentario...',

                inputValidator: comentario => {
                    // Si el valor es válido, debes regresar undefined. Si no, una cadena
                    if (!comentario) {
                        return "Por favor escribe tu comentario";
                    } else {
                        return undefined;
                    }
                }

                }).then((confirmation) => {

                    if(!confirmation.dismiss && confirmation.value){

                        document.getElementById('form_response_body').value = confirmation.value;
                        document.getElementById('form_response_parent_comment_id').value = comment.id;
                        document.getElementById('post_id').value = comment.post.id;

                        formResponse.submit();
                    }

                })
        }

        async function getComment(e){
            try {
            
                let url = e.target.href;

                console.log(url);

                const config = getConfigFetch('GET');

                const resp = await fetch(url, config)
                const datos = await resp.json();

                console.log(datos);

                return datos;

            } catch (error) {
                console.log(error)
            }
        }

        function getConfigFetch(method, data =  null){
            return {
                headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        },
                method: method,
                credentials: "same-origin",
                body: data ? JSON.stringify(data) : null
            }
        }

    </script>

@endpush