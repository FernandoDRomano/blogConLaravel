<nav class="main-header navbar navbar-expand navbar-dark navbar-gray-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard')}}" class="nav-link">Inicio</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          @if (current_user()->unreadNotifications()->count())  
            <span class="badge badge-warning navbar-badge">{{ current_user()->unreadNotifications()->count() }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          @if ( current_user()->unreadNotifications()->count() > 5)  
            <span class="dropdown-item dropdown-header">+{{ current_user()->unreadNotifications()->count() - 5 }} Notificaciones</span>  
          @else
            <span class="dropdown-item dropdown-header">{{ current_user()->unreadNotifications()->count() }} Notificaciones</span>  
          @endif
          
          @forelse (current_user()->unreadNotifications->take(5) as $notification)
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.notifications.show', $notification) }}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> {{ $notification->data['title'] }}
              <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
          @empty
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              No tienes Notificaciones
            </a>
          @endforelse
          
          <div class="dropdown-divider"></div>
            <a href="{{route('admin.notifications.index')}}" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
          </div>
      </li>

    </ul>

  </nav>