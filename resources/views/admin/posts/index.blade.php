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
                <div class="d-flex">
                    @can('create', $post)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fas fa-plus-circle"></i> Nuevo
                        </button>
                    @endcan
    
                    @can('export', Model::class)                        
                        <form action="{{ route('admin.export.posts.excel') }}" method="POST" class="ml-2">
                            @csrf
                            <button class="btn btn-success">
                                <i class="fas fa-file-excel"></i>
                                Exportar a Excel
                            </button>
                        </form>
                    @endcan
                </div>
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

    <form method="POST" id="form-delete">
        @csrf
        @method('DELETE')
    </form>

    <form method="POST" id="form-update">
        @csrf
        @method('PUT')
    </form>


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
                    "serverSide": true,
                    "ajax": "{{ route('admin.posts.all') }}",
                    "columns": [
                        {data: 'id'},
                        {data: 'title'},
                        {data: 'published_at'},
                        {data: 'owner'},
                        {data: 'category'},
                        {data: 'tags'},
                        {data: 'state'},
                        {data: 'btn'}
                    ],
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
        let formUpdate = document.getElementById('form-update');
        let contenedorCreate = document.getElementById('contentErrorsCreate')

        async function updatePostApproved(e){
            try {
                e.preventDefault();

                const post = await getPost(e);

                showModalUpdateApprovedPost(post);

            } catch (error) {
                console.log(error);
            }
        }

        function showModalUpdateApprovedPost(post){
            Swal.fire({
                
                title: `${ post.approved ? 'Desaprobar Post' : 'Aprobar Post' }`,
                html: `
                        ${ post.approved ? 
                            '¿Estás seguro de Desaprobar el Post <strong class="text-danger">' + post.title  + '</strong>?' : 
                            '¿Estás seguro de Aprobar el Post <strong class="text-danger">' + post.title  + '</strong>?' 
                        }
                        
                    `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `${post.approved ? 'Si, Desaprobar el post' : 'Si, Aprobar el post'}`,
                cancelButtonText: 'Cerrar',
                buttonsStyling:false,
                customClass: {
                    confirmButton: `btn text-white mr-2 ${post.approved ? 'btn-danger' : 'btn-info'}`,
                    cancelButton: 'btn btn-outline-secondary'
                },

                }).then((confirmation) => {

                    if (confirmation.value) {
                        updatePost(post);
                    }

            })
        }

        function updatePost(post){
            formUpdate.setAttribute('action', `/admin/posts/${post.url}/approved`);
            formUpdate.submit();
        }

        async function getPostDelete(e) {
            e.preventDefault();
            try {
                const post = await getPost(e);
                
                showModalDeletePost(post);

            } catch (error) {
                console.log(error)
            }
        }

        function showModalDeletePost(post){
            Swal.fire({
                
                title: 'Eliminar Post',
                html: `
                        ¿Estás seguro de eliminar el Post <strong class="text-danger">${post.title}</strong>?
                    `,
                icon: 'warning',
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
                        destroyPost(post);
                    }

            })
        }

        function destroyPost(post) {
            formDestroy.setAttribute('action', `/admin/posts/${post.url}`);
            formDestroy.submit();
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