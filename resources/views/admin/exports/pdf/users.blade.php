<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de usuarios</title>
    <link rel="stylesheet" href="{{ public_path('admin/css/adminlte.min.css') }}">
</head>
<body>
        <h1 class="text-center font-weight-bold text-black-50">Usuarios del Sistema</h1>
        <table class="table table-sm">
            <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permisos Adicionales</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)                          
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->getFullName() }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleDisplayNames() }}</td>
                    <td>{{ $user->getPermissionDisplayNames() }}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
</body>
</html>