  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administración</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/admin/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>

          {{-- MENU ADMINISTRACIÓN --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            {{-- SUB MENU BLOG --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todos los posts</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Crear un post</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>

            {{-- SUB MENU CATEGORIAS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-tags  nav-icon"></i>
                  <p>
                    Categorías
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todos las categorías</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Crear una categoría  </p>
                    </a>
                  </li>                           
                </ul>
              </li>
            </ul>

            {{-- SUB MENU ETIQUETAS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-hashtag nav-icon"></i>
                  <p>
                    Etiquetas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todas las etiquetas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Crear una etiqueta</p>
                    </a>
                  </li>                     
                </ul>
              </li>
            </ul>

            {{-- SUB MENU COMENTARIOS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-comments nav-icon"></i>
                  <p>
                    Comentarios
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver Comentarios</p>
                    </a>
                  </li>                   
                </ul>
              </li>
            </ul>

            {{-- SUB MENU USUARIOS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>
                    Usuarios
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todos los usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Crear un usuario</p>
                    </a>
                  </li>                     
                </ul>
              </li>
            </ul>

            {{-- SUB MENU ROLES --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-id-card-alt nav-icon"></i>
                  <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todos los Roles</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Crear un Role</p>
                    </a>
                  </li>                     
                </ul>
              </li>
            </ul>

            {{-- SUB MENU PERMISOS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-code nav-icon"></i>
                  <p>
                    Permisos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Ver todos los Permisoss</p>
                    </a>
                  </li>                   
                </ul>
              </li>
            </ul>


          </li>{{-- FIN DEL MENU ADMINISTRACIÓN --}}

          {{-- MENU CONFIGURACIÓN --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            {{-- SUB MENU PERMISOS --}}
            <ul class="nav nav-treeview ml-1 ml-lg-2" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-circle nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-lock nav-icon"></i>
                  <p>Cambiar Contraseña</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Cerrar Sesión</p>
                </a>
              </li>      
            </ul>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
