<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/libs/bootstrap-toggle.min.css')}}">
        @include('links')
        

    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main role="main" class="main">
            <div class="container row">
                <h1 class="text-center principal-title col-lg-12">Editar administrador</h1>
                <p class="text-center col-lg-12">Na edição de um administrador, caso <strong>não</strong> preencha a senha, a antiga é mantida</p>
                <form class="col-lg-12" id="form-admin" novalidate autocomplete="off" admin-cod="{{$profile->id}}">
                     <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control"  value="{{$profile->name}}" id="name" placeholder="Nome" required>
                        <div class="invalid-feedback">
                          O nome é obrigatório.
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="login">E-mail:</label>
                        <input type="email" class="form-control" value="{{$profile->login}}" id="login" placeholder="email@gmail.com">
                        <div class="invalid-feedback">
                          O e-mail deve ser válido.
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" placeholder="Senha...">
                        <div class="invalid-feedback">
                          Senha deve conter no mínimo 6 caracteres
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirm_password">Confirmar senha:</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirme a senha...">
                        <div class="invalid-feedback">
                            Senhas devem ser a mesma
                        </div>
                      </div>
                      @if($my_profile == false)
                        <div class="form-group">
                            <label for="access_level">Nível de acesso:</label>
                            <select class="custom-select" id="access_level" placeholder="Nível de acesso">
                              <option value="1" {{$profile->access_level == 1 ? "selected" : ""}}>Master</option>
                              <option value="2" {{$profile->access_level == 2 ? "selected" : ""}}>Analista</option>
                            </select>
                        </div>
                        <div class="form-group ">
                             <label for="active" class="mr-2">Ativo: </label>
                            <input type="checkbox"  {{$profile->active == 'yes' ? "checked" : ""}} data-width="100" data-offstyle="warning" data-on="Sim" data-off="Não" data-style="android" data-onstyle="success"  id="active"  data-toggle="toggle">
                                
                        </div>
                      @endif
                        
                       
                        
                      <button class="btn btn-primary float-right p-2 w-25" type="submit" id="btn-submit">Salvar</button>
                      <div class="clearfix"></div>
                </form>
                
            </div>
            
        </main>
            
        <footer>
            
           @include('footer')
            <script src="{{asset('js/libs/bootstrap-toggle.min.js')}}"></script>
            <script src="{{asset('js/controller/min/admin.min.js')}}"></script>
            <script src="{{asset('js/controller/min/edit-admin.min.js')}}"></script>
        </footer>
        
    </body>
</html>
