<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home admin</title>

        <!-- Fonts -->
        @include('links')

    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main role="main" class="main">
           
            <div class="container row">
                <h1 class="text-center col-lg-12 m-2">Home Admin</h1>
                <div class="card col-lg-8 mx-auto shadow p-3 mb-5 bg-white rounded">
                  <div class="card-body text-center">
                    <h3 class="card-title text-info">Quantidade de Contatos</h5>
                    <p class="card-text text-uppercase h4" id="qtd-contact"></p>
                  </div>
                </div>
                 <div class="card  col-lg-8 mx-auto mt-2 shadow p-3 mb-5 bg-white rounded">
                  <div class="card-body text-center">
                    <h3 class="card-title text-info">Quantidade de telefones</h5>
                    <p class="card-text text-uppercase h4" id="qtd-phone"></p>
                  </div>
                </div>

                <div class="chart-container col-lg-12 mb-1" style=" height:80vh; width:100vw">
                    <canvas id="chart" ></canvas>
                </div>
            </div>
        </main>
            
        <footer>
            
           @include('footer')
           <script src="{{asset('js/libs/Chart.bundle.min.js')}}"></script>
           <script src="{{asset('js/controller/home-admin.js')}}"></script>
        </footer>
        
    </body>
</html>
