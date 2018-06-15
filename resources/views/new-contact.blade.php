<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Novos contatos</title>

        <!-- Fonts -->
        <link href="{{asset('css/libs/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/libs/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/home.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <header>
            @include('navbar-menu');
        </header>
        <main>
             <div>teste</div>
        </main>
           
        <footer>
            @include('footer');
        </footer>
    </body>
</html>

