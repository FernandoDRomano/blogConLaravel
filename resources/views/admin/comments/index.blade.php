@extends('admin.layout')

@section('title', 'Administración de Comentarios')

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
    @include('admin.partials._contentHeader', ["titulo" => "Comentarios"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Comentarios</h3>
            </div>
        </div>
        <div class="card-body">
            <table id="comments" class="table table-bordered  table-hover dataTable dtr-inline">
                <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Post</th>
                        <th>Comentario</th>
                        <th>Usuario</th>
                        <th>Publicado</th>
                        <th>Aprobado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
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

    <script>
        let table = $('#comments').DataTable({
                    "responsive": true, 
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.comments.all') }}",
                    "columns": [
                        {data: 'id'},
                        {data: 'post'},
                        {data: 'comment'},
                        {data: 'owner'},
                        {data: 'published_at'},
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

        let formDestroy = document.getElementById("form-delete");
        let formUpdate = document.getElementById('form-update');

        async function getCommentDelete(e) {
            e.preventDefault();
            try {
                const comment = await getComment(e);
                
                showModalDeleteComment(comment);

            } catch (error) {
                console.log(error)
            }
        }

        function showModalDeleteComment(comment){
            Swal.fire({
                
                title: 'Eliminar Comentario',
                html: `
                        <p>¿Estás seguro de eliminar el Comentario <strong class="text-danger">${comment.body}</strong> 
                        del usuario <strong class="text-warning">${comment.user.last_name}, ${comment.user.name}</strong>?</p>

                        <small>Si lo elimina se eliminaran ${comment.childs.length} comentarios que dependen de este<small>
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
                        destroyComment(comment);
                    }

                })
        }

        function destroyComment(comment) {
            formDestroy.setAttribute('action', `/admin/comments/${comment.id}`);
            formDestroy.submit();
        }

        async function updateCommentApproved(e){
            try {
                e.preventDefault();

                const comment = await getComment(e);

                showModalUpdateApprovedComment(comment);

            } catch (error) {
                console.log(error);
            }
        }

        function showModalUpdateApprovedComment(comment){
            Swal.fire({
                
                title: `${ comment.approved ? 'Desaprobar Comentario' : 'Aprobar Comentario' }`,
                html: `
                        ${ comment.approved ? 
                            '¿Estás seguro de Desaprobar el Comentario <strong class="text-danger">' + comment.body  + '</strong>?' : 
                            '¿Estás seguro de Aprobar el Comentario <strong class="text-danger">' + comment.body  + '</strong>?' 
                        }
                        
                    `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `${comment.approved ? 'Si, Desaprobar el commentario' : 'Si, Aprobar el commentario'}`,
                cancelButtonText: 'Cerrar',
                buttonsStyling:false,
                customClass: {
                    confirmButton: `btn text-white mr-2 ${comment.approved ? 'btn-danger' : 'btn-info'}`,
                    cancelButton: 'btn btn-outline-secondary'
                },

                }).then((confirmation) => {

                    if (confirmation.value) {
                        updateComment(comment);
                    }

            })
        }

        function updateComment(comment){
            formUpdate.setAttribute('action', `/admin/comments/${comment.id}/approved`);
            formUpdate.submit();
        }

        async function getCommentShow(e) {
            e.preventDefault();
            try {
                const comment = await getComment(e);
                
                showModalComment(comment);

            } catch (error) {
                console.log(error)
            }
        }

        function showModalComment(comment){
            Swal.fire({
                
                title: 'Comentario',
                html: `
                        <p class="mb-0">
                            <strong>Usuario</strong>: ${comment.user.last_name}, ${comment.user.name}
                        </p>
                        <p class="mb-0 lead">
                            <strong class="font-weight-bold">Comentario</strong>: ${comment.body}
                        </p>
                    `,
                icon: 'info',
                confirmButtonText: 'Cerrar',

            })
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

        async function getComment(e){
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

    </script>
@endpush