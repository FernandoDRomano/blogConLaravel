@extends('admin.layout')

@section('title', 'Administración de Etiquetas')

@push('links')
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Etiquetas"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Etiquetas</h3>
                @can('create', $tag)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                        <i class="fas fa-plus-circle"></i> Nuevo
                    </button>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table id="tags" class="table table-bordered  table-hover dataTable dtr-inline">
                <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Nombre</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- FORMULARIO --}}
        <form id="form-create" action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <ul class="list-group mb-3 d-none" id="contentErrorsCreate"></ul>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Ingrese el nombre de la Etiqueta" class="form-control">
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

    <!-- Modal Edit-->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white" id="exampleModalLabel">Editar Etiqueta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- FORMULARIO --}}
            <form id="form-edit" action="#" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="tag">

                <div class="modal-body">
                    <ul class="list-group mb-3 d-none" id="contentErrorsEdit"></ul>
    
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="nameEdit" placeholder="Ingrese el nombre de la Etiqueta" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="close" class="btn btn-outline-secondary " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white">Actualizar</button>
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
            let table = $('#tags').DataTable({
                    "responsive": true, 
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.tags.all') }}",
                    "columns": [
                        {data: 'id'},
                        {data: 'name'},
                        {data: 'btn'}
                    ],
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select class="custom-select custom-select-sm form-control form-control-sm">'+
                                    '<option value="10">10</option>'+
                                    '<option value="30">30</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',

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
        const modalUpdate = 'modal-edit';
        let formCreate = document.getElementById("form-create");
        let formUpdate = document.getElementById("form-edit");
        let contenedorCreate = document.getElementById('contentErrorsCreate')
        let contenedorEdit = document.getElementById('contentErrorsEdit')

        async function getTagEdit(e){
            e.preventDefault();
            try {
                const tag = await getTag(e);
                
                $("#modal-edit input[name='name']").val(tag.name);

                document.querySelector('#modal-edit input[name="tag"]').value= tag.url;

                $('#modal-edit').modal('show');

            } catch (error) {
                console.log(error)
            }
        }

        async function getTagDelete(e) {
            e.preventDefault();
            try {
                const tag = await getTag(e);
                
                showModalDeleteTag(tag);

            } catch (error) {
                console.log(error)
            }
        }

        function showModalDeleteTag(tag){
            Swal.fire({
                
                title: 'Eliminar Etiqueta',
                html: `
                        ¿Estás seguro de eliminar la Etiqueta <strong class="text-danger">${tag.name}</strong>?
                        ${tag.posts.length ? '<p class="mb-0 text-muted">Si lo eliminas ' + tag.posts.length + ' Post quedarán sin esta Etiqueta.</p>' : ''}
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
                        destroyTag(tag);
                    }

            })
        }

        async function destroyTag(tag) {
            try {
                let url = '/admin/tags/' + tag.url    

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
                    successActionTag(datos, null)
                }

            } catch (error) {
                console.error(error);
            }
        }

        async function getTag(e){
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
                name: formCreate['name'].value,
            }
            createTag(formCreate.getAttribute('action'), data);
        })

         async function createTag(url, data){

             try {
                const config = getConfigFetch('POST', data)

                const resp = await fetch(url, config);
                const datos = await resp.json();    

                if(datos.success){
                    successActionTag(datos, modalCreate);
                }else{
                    showErrors(datos.errors, contenedorCreate);
                }

             } catch (error) {
                 console.error(error)
             }
            
        }

        formUpdate.addEventListener('submit', e => {
            e.preventDefault();
            let data = {
                name: formUpdate['name'].value,
            }

            const tag = document.querySelector('#modal-edit input[name="tag"]').value;
            updateTag(tag, data);
        });

        async function updateTag(tag, data){
            try {
                const url = '/admin/tags/' + tag
                const config = getConfigFetch('PUT', data)

                const resp = await fetch(url, config)
                
                if(resp.status === 403){
                    showErrors({Error: 'No tienes permisos para realizar esta acción'}, contenedorEdit);
                    return;
                }

                const datos = await resp.json();

                if(datos.success){
                    successActionTag(datos, modalUpdate);
                }else{
                    showErrors(datos.errors, contenedorEdit);
                }

            } catch (error) {
                console.error(error);
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

        function successActionTag(datos, modal){
            closeModal(modal);
            reloadTableAjax();
            showMessageSessionTag(datos);
        }

        function closeModal(modal){
            $(`#${modal}`).modal('hide');
        }

        function reloadTableAjax(){
            table.ajax.reload();
        }

        function clearInputsModal(modal){
            const inputsText = document.querySelectorAll(`#${modal} input[type="text"]`);
            for (let i = 0; i < inputsText.length; i++) {
                inputsText[i].value = '';
            }
        }

        function showErrors(errors, contenedor){
            console.log(errors);
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

        function showMessageSessionTag(datos){

            Swal.fire({
              title: datos.title,
              html: datos.message,
              icon: datos.icon,
              confirmButtonText: 'Cerrar'
            })

        }

        $("#modal-create").on('hidden.bs.modal', function () {
            contenedorCreate.classList.add('d-none');
            
            const inputsText = document.querySelectorAll(`#modal-create input[type="text"]`);
            for (let i = 0; i < inputsText.length; i++) {
                inputsText[i].value = '';
            }
        });

        $("#modal-edit").on('hidden.bs.modal', function () {
            contenedorEdit.classList.add('d-none');
        });


  </script>
@endpush