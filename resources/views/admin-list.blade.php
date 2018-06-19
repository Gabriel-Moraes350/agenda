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
                <h1 class="text-center col-lg-12 m-2 principal-title mb-3">Lista dos administradores</h1>
                <form class="col-lg-12 search-form" autocomplete="off">                        
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" placeholder="Busque um administrador" id="search" >
                      <button search-btn class="btn btn-primary">Buscar</button>
                    </div>
                  </div>
                </form>
                <div class="table-responsive bg-dark mx-auto" id="list-content">
                  
                </div>
                <ul id="pagination" class="pagination-sm mx-auto"></ul>
                
            </div>
        </main>
            
        <footer>
            
           @include('footer')
          <script src="{{ asset('js/libs/jquery.twbsPagination.min.js') }}"></script>
          
          <script src="{{asset('js/controller/min/admin-list.min.js')}}"></script>
        </footer>
        
    </body>
</html>
