<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda</title>

        <!-- Fonts -->
        <link href="{{asset('css/libs/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/libs/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/home.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main role="main">
            <div class="container main__grid">
                <h1 class="text-center principal-title">Agenda</h1>
                <div class="row justify-content-md-center">
                    <form class="col-lg-12 search-form">                        
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
                <div id="preloader" style="display:none;">
                    <img src="/img/loading.gif" class="loading-img" />
                </div>
            </div>
            
        </main>
            
        <footer>
            
           @include('footer');

            <script src="{{asset('js/controller/home-controller.js')}}"></script>
        </footer>
        
    </body>
</html>
