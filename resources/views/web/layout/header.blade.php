<!-- Navbar -->
<nav class="main-header navbar navbar-expand {{ Auth::user()->theme_navbar }} navbar-light ">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('dashboard')}} " class="nav-link">Inicio</a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    
    <!-- Notifications Dropdown Menu 
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    -->
    @if (Auth::user()->theme_body == "")
      <li class="nav-item">
        <a class="nav-link" onclick="event.preventDefault; document.getElementById('theme-form').submit();" href="#" role="button" title="Ativar modo escuro">
          <i class="far fa-moon"></i>
        </a>
      </li>
      <form id="theme-form" action="{{ route('theme',['id' => Auth::user()->id ]) }}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="theme_body" value="dark-mode">  
        <input type="hidden" name="theme_navbar" value="navbar-dark">  
      </form>
        
    @else
      <li class="nav-item">
        <a class="nav-link" onclick="event.preventDefault; document.getElementById('theme-form').submit();" href="#" role="button" title="Ativar modo claro">
          <i class="far fa-sun"></i>
        </a>
      </li>
      <form id="theme-form" action="{{ route('theme',['id' => Auth::user()->id ]) }}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="theme_body" value="">
        <input type="hidden" name="theme_navbar" value="navbar-white">
      </form>
        
    @endif
    

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    
    <!-- Desbilitado para estudar o funcionamento
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    -->
  </ul>
</nav>
<!-- /.navbar -->