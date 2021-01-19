@extends('layout')

@section('title', 'Perfil de ' . $user->getFullName())

@section('content')

<section class="pages container">
    <div class="page">
        <form action="{{ route('subscriber.profile.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                    <div class="row justify-content-center align-content-between">

                        <div class="col-xl-7">

                            <div class="card card-blog card-outline">
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

                                        @if ($user->socialProfiles->count())
                                            <div class="form-group mb-0">
                                                <label class="d-block">Proveedores Sociales Registrados</label>
                                                @foreach ($user->socialProfiles as $profile)
                                                    <p class="btn btn-{{$profile->social_network}}">{{ Str::upper($profile->social_network) }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                    
                                </div>
                            </div>

                            <div class="card card-blog card-outline mb-xl-0">
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

                        <div class="col-xl-5">

                            <div class="card card-blog card-outline h-100">
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
                                    <button type="submit" class="btn btn-blog btn-block text-uppercase">Actualizar Perfil</button>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark mt-2 mt-md-0 btn-block text-uppercase">Volver</a>
                                </div>
                            </div>
                        </div> {{-- .col-lg-8 botones --}}
                    
                    </div>{{-- .row --}}

            
            </div>{{-- .card-body --}}

        </form>
    </div>
</section>

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