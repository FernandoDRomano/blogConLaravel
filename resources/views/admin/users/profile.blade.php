@extends('admin.layout')

@section('title', 'Perfil de Usuario')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 mt-3">
        <div class="card card-row card-info">

            <div class="bg-info py-2 px-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title lea mr-2 d-block">
                Perfil de Usuario
                </h3>
                <a href="{{ route('admin.users.profile', $user) }}" class="d-block link-muted ml-2 text-bold p-0">
                    <i class="fas fa-reply"></i>
                    Volver
                </a>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.users.profile.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center align-content-between">

                        <div class="col-xl-9">

                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Datos del Usuario</h5>
                                </div>
                                <div class="card-body">
                    
                                        <div class="form-group">
                                            <label for="last_name">Apellido</label>
                                            <input 
                                                type="text" 
                                                name="last_name" 
                                                id="last_name" 
                                                value="{{ old('last_name', $user->last_name) }}" 
                                                class="form-control"
                                                placeholder="Ingrese el apellido del usuario">
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" 
                                                name="name" 
                                                id="name" 
                                                value="{{ old('name', $user->name) }}" 
                                                class="form-control" 
                                                placeholder="Ingrese el nombre del usuario">
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input 
                                                type="email" 
                                                name="email" 
                                                id="email"
                                                class="form-control"
                                                value="{{ old('email', $user->email) }}"
                                                placeholder="Ingrese el email del usuario">
                                        </div>
                    
                                </div>
                            </div>

                            <div class="card card-info card-outline mb-xl-0">
                                <div class="card-header">
                                    <h5 class="card-title">Cambiar Contraseña</h5>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            placeholder="Dejar en blanco si no desea cambiar su contraseña."
                                            class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password_confirmation">Repita su Contraseña</label>
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            placeholder="Repita su contraseña."
                                            class="form-control">
                                    </div> 
                                        
                                </div>
                            </div>

                        </div>{{-- .col-xl-9 --}}

                        <div class="col-xl-3">

                            <div class="card card-info card-outline h-100">
                                <div class="card-header">
                                    <h5 class="card-title">Foto de Perfil</h5>
                                </div>
                                <div class="card-body">

                                    <div class="form-group text-center">
                                        <label for="photo" class="d-block">Foto de Perfíl</label>
                                        <img id="photoPreview" src="{{$user->photo}}" alt="Foto de perfil" class="img-fluid rounded-circle" style="height: 250px; width: 250px;">
                                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*">
                                        <p class="text-black-50 mt-2 lead">Hacer click en la imagen para selecionar otra</p>
                                        <p class="text-black-50 mb-0 mt-2 lead">La imagen debe tener un alto y un ancho máximo de 2000px</p>
                                    </div>

                                </div>
                            </div>

                        </div>{{-- .col-xl-3 --}}

                        <div class="col-lg-8 mt-3">
                            <div class="row">
                                <div class="col-md-6 col-xl-8">
                                    <button type="submit" class="btn btn-primary btn-block text-uppercase">Actualizar Usuario</button>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-dark mt-2 mt-md-0 btn-block text-uppercase">Volver</a>
                                </div>
                            </div>
                        </div> {{-- .col-lg-8 botones --}}
                    
                    </div>{{-- .row --}}

                </form>{{-- formulario --}}
            
            </div>{{-- .card-body --}}

        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        const photoPreview = document.getElementById('photoPreview');
        const inputPhoto = document.getElementById('photo');

        if (photoPreview) {
            photoPreview.addEventListener('click', e => {
                inputPhoto.click();
            });   
        }

        if (inputPhoto) {
            inputPhoto.addEventListener('change', e => {
                // Creamos el objeto de la clase FileReader
                let reader = new FileReader();

                // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                reader.readAsDataURL(e.target.files[0]);

                // Le decimos que cuando este listo ejecute el código interno
                reader.onload = function(){
                    let preview = document.getElementById('preview');
                    //let image = document.createElement('img');

                    photoPreview.src = reader.result;

                    // preview.innerHTML = '';
                    // preview.append(image);
                };
            });
        }

    </script>
@endpush


