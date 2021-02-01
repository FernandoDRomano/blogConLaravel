<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario: {{$user->getFullName()}}</title>
    <link rel="stylesheet" href="{{ public_path('admin/css/adminlte.min.css') }}">
</head>
<body class="mt-5">

    <div class="d-block text-center">
        <img src="{{ public_path($user->photo) }}" alt="" style="height: 200px; border-radius: 50%;">
    </div>
    
    <h1 class="text-center font-weight-bold text-uppercase">{{ $user->getFullName() }}</h1>
    
    <p class="mb-0 text-black-50 lead font-weight-bolder text-center">{{ $user->roles->first()->display_name }}</p>
    <p class="text-black-50 lead font-weight-bolder text-center">{{ $user->email }}</p>

    
    @if ($user->socialProfiles->count())
        <h2 class="h4 font-weight-bolder">Proveedores Sociales</h2>
        <table class="table table-sm table-bordered">
            <thead class="bg-info">
                <tr class="text-uppercase">
                    <th>Proveedor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->socialProfiles as $social)                          
                    <tr>
                        <td class="text-capitalize">{{ $social->social_network }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
      
    @if ($user->roles->count())
        <h2 class="h4 font-weight-bolder">Roles</h2>
        <table class="table table-sm table-bordered">
            <thead class="bg-primary">
                <tr class="text-uppercase">
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->roles as $role)                          
                    <tr>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($user->permissions->count())
        <h2 class="h4 font-weight-bolder">Permisos Adicionales</h2>
        <table class="table table-sm table-bordered">
            <thead class="bg-success">
                <tr>
                    <th class="text-uppercase">Nombre</th>
                    <th class="text-uppercase">Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->permissions as $permission)                          
                    <tr>
                        <td>{{ $permission->display_name }}</td>
                        <td>{{ $permission->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($user->posts()->approveds()->count())        
        <h2 class="h4 font-weight-bolder">Posts</h2>
        <table class="table table-sm table-bordered">
            <thead class="bg-danger">
                <tr>
                    <th class="text-uppercase">Id</th>                
                    <th class="text-uppercase">Título</th>
                    <th class="text-uppercase">Extracto</th>
                    <th class="text-uppercase">Fecha de Publicación</th>
                    <th class="text-uppercase">Cantidad de Comentarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts()->approveds()->get() as $post)                          
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->extract }}</td>
                        <td>{{ $post->published_at->format('d-m-Y') }}</td>
                        <td>{{ $post->comments()->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($user->comments->count())
        <h2 class="h4 font-weight-bolder">Comentarios</h2>
        <table class="table table-sm table-bordered">
            <thead class="bg-dark text-white">
                <tr>
                    <th class="text-uppercase">Comentario</th>                
                    <th class="text-uppercase">Fecha de publicación</th>
                    <th class="text-uppercase">Estado</th>
                    <th class="text-uppercase">Post</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->comments as $comment)                          
                    <tr>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                        <td>{{ $comment->approved ? 'Aprobado' : 'No Aprobado' }}</td>
                        <td>{{ $comment->post->title }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

        
</body>
</html>