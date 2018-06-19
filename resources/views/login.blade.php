<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda</title>
        @include('links')


    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main role="main" class="main">
           @include('sign-in')
            
        </main>
            
        <footer>
            
           @include('footer')
           
           <script src="{{asset('js/controller/min/login.min.js')}}"></script>
            
        </footer>
        
    </body>
</html>
