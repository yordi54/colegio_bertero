<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maria de Bertero</title>
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/default-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/child-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/old-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/dark-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/show.css')}}">
        <link rel="stylesheet" href="{{asset('css/google-map.css')}}">
        <script src="{{asset("library-js/html2pdf.bundle.min.js")}}"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    </head>
    <body>
        <x-sidenav></x-sidenav>
        <div id="container-right">
            <x-header></x-header>
            
            <main id="main">
                @yield('content')
            </main>
            
            <x-footer></x-footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{asset('js/RequestFetch.js')}}"></script>
        <script src="{{asset('js/layout.js')}}"></script>
        <script src="{{asset('js/toPDF.js')}}"></script>
        <script src="{{asset('faceapi/face-api.min.js')}}"></script>
        <script src="{{asset('js/load_models.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @yield('js')        
    </body>
</html>
