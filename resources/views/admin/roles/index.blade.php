@extends('admin.layout')

@section('title', 'Administración de Roles')

@push('links')
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Roles"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Roles</h3>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Nuevo
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="roles" class="table table-bordered  table-hover dataTable dtr-inline">
                <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->description }}</td>
                        <td> 
                            @can('update', $role)
                                <a 
                                    href="{{ route('admin.roles.edit', $role) }}" 
                                    class="btn btn-warning text-white btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('delete', $role)
                                <a 
                                    href="{{ route('admin.roles.get', $role) }}" 
                                    class="btn btn-danger btn-sm"
                                    onclick="getRoleDelete(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </a>   
                            @endcan 
                            
                            @can('view', $role)
                                <a href="{{route('admin.roles.show', $role)}}"
                                    class="btn btn-dark btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            
                        </td>
                    </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
  </div>

<!-- Modal delete-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar Role</h5>
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

                <input type="hidden" name="role">
                <p name="message" class="h4 text-center m-3"></p>
            
            </div>

            <div class="modal-footer">
                <button type="close" class="btn btn-outline-secondary " data-dismiss="modal">Cerrar</button>
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
        let table = $('#roles').DataTable({
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

        const modalDestroy = 'modal-delete';
        let formDestroy = document.getElementById("form-delete");
        let contenedorDelete = document.getElementById('contentErrorsDelete')

        async function getRoleDelete(e) {
            e.preventDefault();
            try {
                const role = await getRole(e);
                
                document.querySelector('#modal-delete p[name="message"]').innerHTML = `
                    ¿Estás seguro de eliminar el Role <strong class="text-danger">${role.display_name}</strong>?
                `;

                document.querySelector('#modal-delete input[name="role"]').value= role.id;

                $('#modal-delete').modal('show');

            } catch (error) {
                console.log(error)
            }
        }

        async function getRole(e){
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

        formDestroy.addEventListener('submit', e => {
            e.preventDefault();
            const role = document.querySelector('#modal-delete input[name="role"]').value;
            formDestroy.setAttribute('action', `/admin/roles/${role}`)
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


  </script>
@endpush