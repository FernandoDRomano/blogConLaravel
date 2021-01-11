<header class="space-inter">
    <div class="container d-flex justify-content-between align-items-center pt-5">
        <a href="{{ route('pages.blog') }}" class="d-flex aling-items-center">
            <figure class="logo"><img src="/img/logo.png" alt=""></figure>
        </a>
        <nav class="custom-wrapper" id="menu">
            <div class="pure-menu"></div>
            {{-- <ul class="container-flex list-unstyled"> --}}
            <ul class="d-flex aling-items-center list-unstyled mb-0">
                <li><a href="{{ route('pages.blog') }}" class="text-uppercase a-link mx-3">Home</a></li>
                <li><a href="{{ route('pages.about') }}" class="text-uppercase a-link mx-3">About</a></li>
                <li><a href="{{ route('pages.archive') }}" class="text-uppercase a-link mx-3">Archive</a></li>
                <li><a href="{{ route('pages.contact') }}" class="text-uppercase a-link mx-3">Contact</a></li>
                @auth   
                    <li class="position-relative">
                        <a href="#" class="text-uppercase a-link mx-3" id="mi-cuenta">Mi Cuenta</a>
                        <div id="menu-desplegable" class="d-none">
                            <ul class="list-unstyled d-flex flex-column menu-desplegable">
                                <li class="text-center">
                                    <img src="{{ current_user()->photo }}" alt="{{ current_user()->getFullName() }}" id="img-navbar" style="height: 50px; width: 50px;" class="rounded-circle">
                                    <p class="m-0 small">{{ current_user()->getFullName() }}</p>
                                    <small class="font-weight-bold">{{ current_user()->getRoleNames()->first() }}</small>
                                </li>
                                @can('view-dashboard', current_user())
                                    <li>
                                        <a href="{{route('admin.dashboard')}}" target="_blank" class="text-left text-uppercase">Administración</a>
                                    </li>
                                @endcan
    
                                @can('view-dashboard', current_user())                                
                                    <li>
                                        <a href="{{route('admin.users.profile.edit', current_user())}}" class="text-left text-uppercase">Perfil</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('subscriber.profile', current_user()) }}" class="text-left text-uppercase">Perfil</a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="#" onclick="document.getElementById('logout').submit()" class="text-left text-uppercase">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                    </li> 
                @else
                    <li><a href="{{ route('login') }}" class="text-uppercase a-link mx-3">Ingresar</a></li>
                    <li><a href="{{ route('register') }}" class="text-uppercase a-link mx-3">Registrarse</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<form id="logout" action="{{ route('logout') }}" method="POST">
    @csrf 
</form>

@push('script')

<script>

    const btnMiCuenta = document.getElementById('mi-cuenta');
    const menuDesplegable = document.getElementById('menu-desplegable');

    if (btnMiCuenta && menuDesplegable) {

        btnMiCuenta.addEventListener('click', e => {
            menuDesplegable.classList.toggle('d-block');
        });

    }

</script>

@endpush
