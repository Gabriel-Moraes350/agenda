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
   
      <a class="btn btn-outline-info  my-sm-0" id="btn-login" href="{{route('sign-in')}}">Login</a>
  </div>
</nav>