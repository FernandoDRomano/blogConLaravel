@extends('admin.layout')

@section('title', 'Administración de Posts')

@push('links')
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
@endpush

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Posts"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Posts</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                    <i class="fas fa-plus-circle"></i> Nuevo
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="posts" class="table table-bordered  table-hover dataTable dtr-inline">
                <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Título</th>
                        <th>Publicado</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Etiquetas</th>
                        <th>Aprobado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ Str::limit($post->title, 20) }}</td>
                        <td>{{ $post->published_at ? $post->published_at->format('d-m-Y') : '' }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category ? $post->category->name : '' }}</td>
                        <td>
                            @forelse ($post->tags as $tag)
                                <p class="d-inline lead"><span class="badge badge-pill badge-info">{{$tag->name}}</span></p>
                            @empty
                                <p class="lead"><span class="badge badge-pill badge-light">No tiene Etiquetas</span></p>
                            @endforelse
                        </td>
                        <td>
                            @if ($post->approved)
                                <p class="lead d-inline"><span class="badge badge-pill badge-success">Aprobado</span></p>
                            @else
                                <p class="lead"><span class="badge badge-pill badge-secondary">Falta aprobar</span></p>
                            @endif
                        </td>
                        <td> 
                            <a 
                                href="{{ route('admin.posts.edit', $post) }}" 
                                class="btn btn-warning text-white btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a 
                                href="{{ route('admin.posts.get', $post) }}" 
                                class="btn btn-danger btn-sm"
                                onclick="getPostDelete(event)">
                                <i class="fas fa-trash-alt"></i>
                            </a>    
                            
                            <a href="{{route('admin.posts.show', $post)}}"
                                target="_blank"
                                class="btn btn-dark btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
  </div>

  <!-- Modal Create-->
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- FORMULARIO --}}
        <form id="form-create" action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <ul class="list-group mb-3 d-none" id="contentErrorsCreate"></ul>

                <div class="form-group">
                    <label for="title">Nombre</label>
                    <input type="text" name="title" id="title" placeholder="Ingrese el titulo del post" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="close" class="btn btn-outline-secondary " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
         </form>
      </div>
    </div>
  </div>

    <!-- Modal delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- FORMULARIO --}}
            <form id="form-delete" action="#" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <ul class="list-group mb-3 d-none" id="contentErrorsDelete"></ul>

                    <input type="hidden" name="post">
                    <p name="message" class="h4 text-center m-3"></p>
                
                </div>

                <div class="modal-footer">
                    <button type="close" class="btn btn-outline-secondary " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger text-white">Eliminar</button>
                </div>
             </form>
          </div>
        </div>
    </div>


@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        let table = $('#posts').DataTable({
                    "responsive": true, 
                    "autoWidth": false,
                    "processing": true,
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": `
                            Mostrar 
                                <select class="custom-select custom-select-sm form-control form-control-sm"> 
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="-1">Todos</option>
                                </select> 
                            registros
                        `,
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias", 
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }
        });

        const modalCreate = 'modal-create';
        const modalDestroy = 'modal-delete';
        let formCreate = document.getElementById("form-create");
        let formDestroy = document.getElementById("form-delete");
        let contenedorCreate = document.getElementById('contentErrorsCreate')

        async function getPostDelete(e) {
            e.preventDefault();
            try {
                const post = await getPost(e);
                
                document.querySelector('#modal-delete p[name="message"]').innerHTML = `
                    ¿Estás seguro de eliminar el Post <strong class="text-danger">${post.title}</strong>?
                `;

                document.querySelector('#modal-delete input[name="post"]').value= post.url;

                $('#modal-delete').modal('show');

            } catch (error) {
                console.log(error)
            }
        }

        async function getPost(e){
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

        formCreate.addEventListener('submit', e => {
            e.preventDefault();
            let data = {
                title: formCreate['title'].value,
            }
            createPost(formCreate.getAttribute('action'), data);
        })

         async function createPost(url, data){

             try {
                const config = getConfigFetch('POST', data)

                const resp = await fetch(url, config);
                const datos = await resp.json();    

                console.log(datos);

                if(datos.success){
                    window.location = datos.url;
                }else{
                    showErrors(datos.errors, contenedorCreate);
                }

             } catch (error) {
                 console.error(error)
             }
            
        }

        formDestroy.addEventListener('submit', e => {
            e.preventDefault();
            const post = document.querySelector('#modal-delete input[name="post"]').value;
            formDestroy.setAttribute('action', `/admin/posts/${post}`)
            formDestroy.submit();
        })

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

        function showErrors(errors, contenedor){
            contenedor.innerHTML = '';

            let li = '';

            for (const propiedad in errors) {
                li += `
                    <li class="list-group-item list-group-item-danger"> <strong>${propiedad}</strong> : ${errors[propiedad]}</li>
                `;
            }

            contenedor.innerHTML += li;
            contenedor.classList.remove('d-none');
        }

        $("#modal-create").on('hidden.bs.modal', function () {
            contenedorCreate.classList.add('d-none');
            clearInputsModal(modalCreate);
        });

  </script>
@endpush