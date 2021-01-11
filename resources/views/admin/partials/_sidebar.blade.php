  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administración</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ current_user()->photo }}" class="img-circle elevation-2" alt="{{current_user()->getFullName()}}" style="height: 35px; width: 35px;" >
        </div>
        <div class="info">
          <p class="mb-0">
            <a href="{{ route('admin.users.profile', current_user() ) }}" class="">{{ current_user()->getFullName() }}</a>
          </p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActive('admin.dashboard') }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
  
          <li class="nav-item">
            <a href="{{ route('pages.blog') }}" class="nav-link"  target="_blank">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Sitio Web del Blog
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview {{request()->routeIs('admin.dashboard') ? '' : 'menu-open'}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              
              @can('view', $post)                
                <li class="nav-item">
                  <a href="{{route('admin.posts.index')}}" class="nav-link {{ isActive('admin.posts.*') }}">
                    <i class="fas fa-book-open nav-icon"></i>
                    <p>
                      Blog
                    </p>
                  </a>
                </li>
              @endcan

              @can('view', $category)                
                <li class="nav-item">
                  <a href="{{route('admin.categories.index')}}" class="nav-link {{ isActive('admin.categories.*') }}">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>
                      Categorías
                    </p>
                  </a>
                </li>
              @endcan

              @can('view', $tag)                
                <li class="nav-item">
                  <a href="{{route('admin.tags.index')}}" class="nav-link {{ isActive('admin.tags.*') }}">
                    <i class="fas fa-hashtag nav-icon"></i>
                    <p>
                      Etiquetas
                    </p>
                  </a>
                </li>
              @endcan

              @can('view', $comment)                
                <li class="nav-item">
                  <a href="{{route('admin.comments.index')}}" class="nav-link {{ isActive('admin.comments.*') }}">
                    <i class="fas fa-comments nav-icon"></i>
                    <p>
                      Comentarios
                    </p>
                  </a>
                </li>
              @endcan

              @can('view', $user)                
                <li class="nav-item">
                  <a href="{{route('admin.users.index')}}" class="nav-link {{ isActive(['admin.users.index', 'admin.users.show', 'admin.users.create', 'admin.users.edit']) }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>
                      Usuarios
                    </p>
                  </a>
                </li>
              @endcan
              
              @can('view', $role)                
                <li class="nav-item">
                  <a href="{{route('admin.roles.index')}}" class="nav-link {{ isActive('admin.roles.*') }}">
                    <i class="fas fa-id-card-alt nav-icon"></i>
                    <p>
                      Roles
                    </p>
                  </a>
                </li>
              @endcan

              @can('view', $permission)                
                <li class="nav-item">
                  <a href="{{route('admin.permissions.index')}}" class="nav-link {{ isActive('admin.permissions.*') }}">
                    <i class="fas fa-code nav-icon"></i>
                    <p>
                      Permisos
                    </p>
                  </a>
                </li>
              @endcan

              <li class="nav-item">
                <a href="{{ route('admin.users.profile', current_user()) }}" class="nav-link {{ isActive(['admin.users.profile', 'admin.users.profile.edit']) }}">
                  <i class="fas fa-user-circle nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-change-password">
                  <i class="fas fa-user-lock nav-icon"></i>
                  <p>Cambiar Contraseña</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link" onclick="document.getElementById('logout').submit()">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Cerrar Sesión</p>
                </a>
              </li>     
              
            </ul>

          </li>

          <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none">
            @csrf
          </form>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

@include('admin.users._changePassword')