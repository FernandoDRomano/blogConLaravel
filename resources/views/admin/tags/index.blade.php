@extends('admin.layout')

@section('title', 'Administración de Etiquetas')

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
    @include('admin.partials._contentHeader', ["titulo" => "Etiquetas"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Etiquetas</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                    <i class="fas fa-plus-circle"></i> Nuevo
                </button>
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

    <!-- Modal delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar Etiqueta</h5>
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

                    <input type="hidden" name="tag">
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

    <!-- SweetAlert2 -->
    <script src="/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="/admin/plugins/toastr/toastr.min.js"></script>

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

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            width: '50rem',
            padding: '1rem',
            timerProgressBar: true,
        })

        const modalCreate = 'modal-create';
        const modalUpdate = 'modal-edit';
        const modalDestroy = 'modal-delete';
        let formCreate = document.getElementById("form-create");
        let formUpdate = document.getElementById("form-edit");
        let formDestroy = document.getElementById("form-delete");
        let contenedorCreate = document.getElementById('contentErrorsCreate')
        let contenedorEdit = document.getElementById('contentErrorsEdit')
        let contenedorDelete = document.getElementById('contentErrorsDelete')

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
                
                document.querySelector('#modal-delete p[name="message"]').innerHTML = `
                    ¿Estás seguro de eliminar la etiqueta <strong class="text-danger">${tag.name}</strong>?
                `;

                document.querySelector('#modal-delete input[name="tag"]').value= tag.url;

                $('#modal-delete').modal('show');

            } catch (error) {
                console.log(error)
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

                console.log(datos);

                if(datos.success){
                    successAction(datos.session, modalCreate)
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
                const datos = await resp.json();

                if(datos.success){
                    successAction(datos.session, modalUpdate)
                }else{
                    showErrors(datos.errors, contenedorEdit);
                } 

            } catch (error) {
                console.error(error);
            }

        }

        formDestroy.addEventListener('submit', e => {
            e.preventDefault();
            const tag = document.querySelector('#modal-delete input[name="tag"]').value;

            destroyTag(tag);
        })

        async function destroyTag(tag) {
            try {
                let url = '/admin/tags/' + tag     

                const config = getConfigFetch('DELETE')

                const resp = await fetch(url, config)
                const datos = await resp.json();

                if(datos.success){
                    successAction(datos.session, modalDestroy)
                }else{
                    let errors = {
                        Error: 'Se produjo un error inesperado en el sistema, y no se pudo eliminar'
                    }

                    showErrors(errors, contenedorDelete);
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

        function successAction(message, modal){
            clearInputsModal(modal);
            closeModal(modal);
            reloadTableAjax();
            showMessageSession(message);
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

        function showMessageSession(message){

            Toast.fire({
                icon: 'success',
                title: `${message}`,
            })

        }

        $("#modal-create").on('hidden.bs.modal', function () {
            contenedorCreate.classList.add('d-none');
            clearInputsModal(modalCreate);
        });

        $("#modal-edit").on('hidden.bs.modal', function () {
            contenedorEdit.classList.add('d-none');
        });

        $("#modal-delete").on('hidden.bs.modal', function () {
            contenedorDelete.classList.add('d-none');
        });


  </script>
@endpush