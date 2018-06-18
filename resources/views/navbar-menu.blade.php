<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="{{route('home')}}">Agenda</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" id="new-contact" href="{{route('new-contact')}}">Novo contato</a>
      </li>
    </ul>
      @if(!empty($admin))
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu administrador
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" admin-access="{{$admin->id}}">
          <a class="dropdown-item" href="{{route('admin-home')}}">Home admin</a>
          <a class="dropdown-item" href="{{route('my-profile')}}">Meu perfil</a>
          @if($admin->access_level == 1)
            <a class="dropdown-item" href="{{route('admin-new')}}">Cria administrador</a>
            <a class="dropdown-item" href="{{route('admin-list')}}">Lista administradores</a>
          @endif
          <a class="dropdown-item" href="/logout">Sair</a>
        </div>
      </div>
      @else
      <a class="btn btn-outline-info  my-sm-0" id="btn-login" href="{{route('login')}}">Login</a>
      @endif
  </div>
</nav>

<div id="preloader" style="display:none;">
    <img src="/img/loading.gif" class="loading-img" />
</div>  