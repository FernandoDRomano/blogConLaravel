@extends('admin.layout')

@section('title', 'Administración de Usuarios')

@push('links')
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('contentHeader')
    @include('admin.partials._contentHeader', ["titulo" => "Usuarios"])
@endsection

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="contenedor d-flex justify-content-between align-items-center">
                <h3 class="h3 mb-0">Administración de Usuarios</h3>
                
                @can('create', $user)
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Nuevo
                    </a>
                @endcan

            </div>
        </div>
        <div class="card-body">
            <table id="usuarios" class="table table-bordered  table-hover dataTable dtr-inline">
                <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Permisos Adicionales</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->getFullName() }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleDisplayNames() }}</td>
                        <td>{{ $user->getPermissionDisplayNames() }}</td>
                        <td> 

                            @can('update', $user)
                                <a 
                                    href="{{ route('admin.users.edit', $user) }}" 
                                    class="btn btn-warning text-white btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('delete', $user)
                                <a 
                                    href="{{ route('admin.users.get', $user) }}" 
                                    class="btn btn-danger btn-sm"
                                    onclick="getUserDelete(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </a>   
                            @endcan

                            @can('view', $user)
                                <a href="{{route('admin.users.show', $user)}}"
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

  <form class="d-none" method="POST" id="delete-user">
     @csrf
     @method('DELETE')
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
        let table = $('#usuarios').DataTable({
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

        async function getUserDelete(e) {
            e.preventDefault();
            try {
                const user = await getUser(e);
                
               showModalDeleteUser(user);

            } catch (error) {
                console.log(error)
            }
        }


        async function getUser(e){
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

                console.log(datos);

                return datos;

            } catch (error) {
                console.log(error)
            }
        }

        function showModalDeleteUser(user){
            Swal.fire({
                
                title: 'Eliminar Usuario',
                html: `¿Estás seguro de eliminar el Usuario <strong class="text-danger">${user.last_name}, ${user.name}</strong>?` ,
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
                        deleteUser(user);
                    }

            })
        }

        function deleteUser(user){
            form = document.getElementById('delete-user');
            form.setAttribute('action', `/admin/users/${user.id}`);
            form.submit();
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