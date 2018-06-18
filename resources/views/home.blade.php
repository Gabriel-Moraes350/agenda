<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda</title>

        <!-- Fonts -->
        @include('links')

    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main role="main" class="main">
            <div class="container main__grid">
                <h1 class="text-center principal-title">Agenda</h1>
                <p class="text-center">Clique para no <strong>nome</strong> do contato para ver mais detalhes</p>
                <div class="row justify-content-md-center">
                    <form class="col-lg-12 search-form" autocomplete="off">                        
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <input type="text" class="form-control" placeholder="Busque um contato" id="search" >
                          <button search-btn class="btn btn-primary">Buscar</button>
                        </div>
                      </div>
                    </form>
                </div>
                
                <div id="accordion" >

                </div>
                
            </div>
            
        </main>
            
        <footer>
            
           @include('footer')
           
            <script src="{{asset('js/model/User.js')}}"></script>

            <script src="{{ asset('js/libs/jquery.twbsPagination.min.js') }}"></script>
            
            <script src="{{asset('js/controller/home-controller.js')}}"></script>
        </footer>
        
    </body>
</html>
