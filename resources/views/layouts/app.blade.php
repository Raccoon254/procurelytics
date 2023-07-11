<html data-theme="light" lang="">
    <head>
        <title>@yield('title')</title>
        <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
        <!-- <script src="{{ asset('node_modules/chart.js/dist/chart.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <!-- Fonts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    @section('navbar')
        @include('layouts.navbar')
    @show

        <div class="container">
            @yield('content')
        </div>
        @section('sidebar')
            @include('layouts.sidebar')
        @show

    <script>
        // get the theme switch checkbox
        const themeSwitch = document.querySelector('#theme-switch');

        themeSwitch.addEventListener('change', () => {
            // get the html element
            const html = document.querySelector('html');

            // change the theme
            if (themeSwitch.checked) {
                html.setAttribute('data-theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
            }
        });
    </script>
    </body>
</html>
