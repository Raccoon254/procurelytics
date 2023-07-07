<html lang="">
    <head>
        <title>@yield('title')</title>
        <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        @section('sidebar')
        @show
    </body>
</html>
