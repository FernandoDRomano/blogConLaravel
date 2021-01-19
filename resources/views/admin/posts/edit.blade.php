@extends('admin.layout')

@section('title', 'Edición de Post')

@push('links')
     <!-- summernote -->
    <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
    {{-- DATE PICKER --}}
    <link rel="stylesheet" href="/admin/plugins/datepicker/css/bootstrap-datepicker.min.css">
      <!-- Select2 -->
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- DROPZONE --}}
{{--     <link rel="stylesheet" href="/admin/plugins/dropzone/dist/min/basic.min.css">
 --}}    <link rel="stylesheet" href="/admin/plugins/dropzone/dist/min/dropzone.min.css">
@endpush

@section('content')

 

<form action="{{ route('admin.posts.update', $post) }}" method="POST" class="my-3">

    @csrf
    @method('PUT')

    <div class="card card-row card-info">
        <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
          <h3 class="card-title lea mr-2 d-block">
           Editar Post
          </h3>
          <a href="{{ url()->previous() }}" class="d-block link-muted ml-2 text-bold p-0">
            <i class="fas fa-reply"></i>
            Volver
          </a>
        </div>
        <div class="card-body">
          <div class="row">
              {{-- PRIMERA COLUMNA --}}
              <div class="col-lg-6 col-xl-7 mb-3 mb-lg-0">
                <div class="card card-info card-outline h-100">
                    <div class="card-header">
                      <h5 class="card-title">Contenido</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Título</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control {{ $errors->first('title') ? 'is-invalid' : '' }}" 
                                placeholder="Ingresa el título de la publicación"
                                value="{{ old('title', $post->title) }}">
                            @if ($errors->first('title'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('title') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="extract">Extracto</label>
                            <textarea 
                                name="extract" 
                                id="extract" 
                                cols="30" 
                                rows="3" 
                                class="form-control {{ $errors->first('extract') ? 'is-invalid' : '' }}" 
                                placeholder="Ingresa el extracto de la publicación">{{ old('extract', $post->extract) }}</textarea>
                            @if ($errors->first('extract'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('extract') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="body">Cuerpo</label>
                            <textarea 
                                id="body" 
                                class="form-control {{ $errors->first('body ') ? 'is-invalid' : '' }}" 
                                name="body">{{ old('body', $post->body) }}</textarea>
                            @if ($errors->first('body'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('body') }}</small>
                            @endif
                        </div>
                    </div>
                  </div>
              </div>

              {{-- SEGUNDA COLUMNA --}}
              <div class="col-lg-6 col-xl-5 d-flex flex-column justify-content-between">
                  
                    <div class="card card-info card-outline">
                      <div class="card-header">
                          <h5 class="card-title">Fecha de publicación</h5>
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                            <label for="published_at">Fecha</label>
                            <div class="input-group date" id="published_at" data-target-input="nearest">
                                <input 
                                    type="text" 
                                    name="published_at" 
                                    class="form-control datetimepicker-input" 
                                    data-target="#published_at"
                                    value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d') : null  ) }}"/>
                                <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @if ($errors->first('published_at'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('published_at') }}</small>
                            @endif
                        </div>
                    </div>
                  </div>

                  <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Contenido embebido (iframe)</h5>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                          <label for="iframe">Iframe</label>
                          <textarea 
                            name="iframe" 
                            id="iframe" 
                            cols="30" 
                            rows="2" 
                            class="form-control" 
                            placeholder="Pegue aquí el iframe de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
                            @if ($errors->first('iframe'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('iframe') }}</small>
                            @endif
                      </div>
                  </div>
                </div>

                  <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Categoría</h5>
                    </div>
                    <div class="card-body">

                      <div class="form-group">
                        <label for="category_id">Elegir</label>
                        <select 
                            id="category_id" 
                            name="category_id" 
                            class="form-control select2bs4 select2-hidden-accessible {{ $errors->first('category_id') ? 'is-invalid' : ''}}" 
                            style="width: 100%;">
                                <option value="">Seleccione una Categoría</option>
                            @forelse ($categories as $category)
                                <option 
                                    value="{{$category->id}}"
                                    @if (old('category_id', $post->category_id) == $category->id)
                                        selected
                                    @endif> 
                                    {{ $category->name }} 
                                </option>
                            @empty
                                <option value="">No existen categorías</option>
                            @endforelse
                        </select>
                        @if ($errors->first('category_id'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('category_id') }}</small>
                        @endif
                      </div>

                  </div>
                </div>

                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Etiquetas</h5>
                    </div>
                    <div class="card-body">

                      <div class="form-group">
                        <label for="tags">Elegir</label>
                        <select 
                            id="tags" 
                            name="tags[]"  
                            multiple="multiple" 
                            class="form-control select2bs4 select2-hidden-accessible {{ $errors->first('tags') ? 'is-invalid' : ''}}" 
                            style="width: 100%;">
                            @forelse ($tags as $tag)
                                <option 
                                    value="{{$tag->id}}"
                                    {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}> 
                                    {{ $tag->name }} 
                                </option>
                            @empty
                                <option value="">No existen etiquetas</option>
                            @endforelse
                        </select>

                        @if ($errors->first('tags'))
                                <small class="text-danger font-weight-bold">{{ $errors->first('tags') }}</small>
                        @endif

                      </div>

                  </div>
                </div>

                <div class="form-group mb-0">
                    <div class="row">
                        <div class="col-xl-8 mb-2 mb-xl-0">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Guardar cambios</button>
                        </div>
                        <div class="col-xl-2 mb-2 mb-xl-0">
                            <a href="{{route('admin.posts.show', $post)}}"
                                target="_blank"
                                class="btn btn-success btn-block text-uppercase">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                        <div class="col-xl-2">
                            <a href="{{ route('admin.posts.index') }}" 
                                class="btn btn-block btn-dark text-uppercase">
                                <i class="fa fa-reply"></i>
                            </a>
                        </div>
                    </div>
                </div>

              </div>
          </div>
        </div>
    </div>

</form>

{{-- SECCIÓN DE IMAGENES --}}
<div class="card card-row card-info">
        <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
            <h3 class="card-title lea mr-2 d-block">
            Imagenes del Post
            </h3>
            <a href="{{ url()->previous() }}" class="d-block link-muted ml-2 text-bold p-0">
            <i class="fas fa-reply"></i>
            Volver
            </a>
        </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-5 mb-3 mb-lg-0">

                    
                    <div class="card card-info card-outline h-100">
                        <div class="card-header">
                            <h5 class="card-title">Subir Imagenes</h5>
                        </div>
                        <div class="card-body">
                            <div class="h-100 dropzone border-info lead rounded"></div>
                        </div>
                    </div>


                  </div>
                  <div class="col-lg-7">

                    <div class="card card-info card-outline h-100">
                        <div class="card-header">
                          <h5 class="card-title">Imagenes Subidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center" id="contentImages">
                                @forelse ($images as $image)
                                    <div class="col-12 col-md-6 col-xl-4 mb-2" id="{{ $image->id }}">                                           
                                        <a href="{{ route('admin.images.get', $image) }}" class="btn btn-danger float-right" style="position: absolute" onclick="getImageDelete(event)">
                                            <i class="fas fa-times"></i>
                                       </a>
                                        <img src="/storage/{{ $image->url }}" alt="{{ $post->title }}" class="img-fluid mb-2" style="min-height: 10rem;" >
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p id="messageEmpty" class="text-center lead">Ups este Post no tiene imagenes cargadas aún!!</p>
                                    </div>
                                @endforelse
                             </div>
                        </div>
                    </div>

                  </div>
              </div>
          </div>
</div>

@endsection

@push('script')
    <!-- Summernote -->
    <script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>

    {{-- DATE PICKER --}}
    <script src="/admin/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/admin/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>

    <!-- Select2 -->
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>
    <script src="/admin/plugins/select2/js/i18n/es.js"></script>

    {{-- DROPZONE --}}
    <script src="/admin/plugins/dropzone/dist/min/dropzone.min.js"></script>

    <!-- Page specific script -->
    <script>


        $(function () {

            // Summernote
            $('#body').summernote({
                height: 375,
            })

            //datepicker published_at
            $('#published_at').datepicker({
                format: 'yyyy-m-d',
                startDate: '-0d',
                clearBtn: true,
                language: "es",
                orientation: "bottom auto",
                autoclose: true
            });

            //Initialize Select2 category_id
            $('#category_id').select2({
                theme: 'bootstrap4'
            })

            //Initialize Select2 tags
            $('#tags').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccione hasta 3 etiquetas',
                maximumSelectionLength: 3,
                language: "es"
            })

        });

        Dropzone.autoDiscover = false;

        const myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/images',
            paramName: 'image',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Haz click o arrastra las fotos aquí para subirlas',

            success: function (file, response) {
                setTimeout(() => {
                    addImageDOM(response);
                    this.removeFile(file);
                    //showMessage();
                }, 1000);
            },  

        });

        myDropzone.on('error', function(file, res){
            let msg = res.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        function addImageDOM(image){
            const contentImages = document.getElementById('contentImages');
            let html = `
                <div class="col-12 col-md-6 col-xl-4 mb-2" id="${image.id}">
                    <a href="/admin/images/${image.id}" class="btn btn-danger float-right" style="position: absolute" onclick="getImageDelete(event)">
                        <i class="fas fa-times"></i>
                    </a>
                    <img src="/storage/${image.url}" alt="{{ $post->title }}" class="img-fluid mb-2" style="min-height: 10rem;" >
                </div>
            `;

            contentImages.innerHTML += html;

            ifExistRemoveMessageEmpty();
        }

        async function getImageDelete(e) {
            e.preventDefault();
            try {
                const image = await getImage(e);
                
                showModalDeleteImage(image);

            } catch (error) {
                console.log(error)
            } 
        }

        function showModalDeleteImage(image){
            Swal.fire({
                
                title: 'Eliminar Imagen',
                html: `
                        ¿Estás seguro de eliminar esta imagén?
                    `,
                icon: 'warning',
                imageUrl: `/storage/${image.url}`,
                imageWidth: 400,
                imageHeight: 300,
                imageAlt: 'Custom image',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cerrar',
                buttonsStyling:false,
                customClass: {
                    confirmButton: 'btn btn-danger text-white mr-2',
                    cancelButton: 'btn btn-outline-secondary'
                },

                }).then((confirmation) => {

                    if (confirmation.value) {
                        destroyImage(image);
                    }

            })
        }

        async function destroyImage(image) {
            try {
                let url = `/admin/posts/${image.post.url}/images/${image.id}`;

                const config = getConfigFetch('DELETE')

                const resp = await fetch(url, config)

                if(resp.status === 403){
                    Swal.fire({
                        title: 'Ups Error',
                        html: '<strong>No tienes permisos para realizar esta acción</strong>',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    })
                    return;
                }

                const datos = await resp.json();

                if(datos.success){
                    deleteImageDOM(image.id);
                }

            } catch (error) {
                console.error(error);
            }
        }

        async function getImage(e){
            try {
            
                let url = '';

                if(e.target.classList.contains('fas')){
                    url = e.target.parentNode.href;
                }else{
                    url = e.target.href;
                }  

                const config = getConfigFetch('GET');

                const resp = await fetch(url, config)
                const datos = await resp.json();

                return datos;

            } catch (error) {
                console.log(error)
            }

        }

        const formDelete = document.getElementById('form-delete');

        function deleteImageDOM(idImage){

            const nodoHijo = document.getElementById(idImage);
            const nodoPadre = nodoHijo.parentNode;

            nodoPadre.removeChild(nodoHijo);

            checkForEmptyMessage();

        }

        function ifExistRemoveMessageEmpty(){
            let messageEmpty = document.getElementById('messageEmpty');

            if (messageEmpty) {
                let father = messageEmpty.parentNode;
                father.removeChild(messageEmpty);
            }
        }

        function checkForEmptyMessage(){
            let containsImages = document.querySelectorAll('#contentImages img')
            
            if (containsImages.length == 0) {
                addMessageEmpty();
            }
        }

        function addMessageEmpty(){
            let contains = document.getElementById('contentImages');
            let html = `
                <div class="col-12">
                    <p id="messageEmpty" class="text-center lead">Ups este Post no tiene imagenes cargadas aún!!</p>
                </div>
            `;

            contains.innerHTML += html;
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