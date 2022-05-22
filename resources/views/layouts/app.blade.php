<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Zen+Old+Mincho&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css').'?'.time() }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/swiper.js') }}"></script>
    <script src="{{ mix('js/main.js') }}"></script>
</head>

<body>
    <!-- Page Heading -->
    <header id="header">
        <div class="wrapper">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
        </div>

        <div class="sp-menu">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="sp-menu--nav">
                <ul class="sp-menu--parts">
                    <li class="sp-menu--list"><a href="#">room</a></li>
                    <li class="sp-menu--list"><a href="#">restaurant</a></li>
                    <li class="sp-menu--list"><a href="#">spa</a></li>
                    <li class="sp-menu--list"><a href="#">services</a></li>
                    <li class="sp-menu--list"><a href="#">access</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Page Content -->
    @yield('content')

    <footer id="footer">
        <p class="name">&copy; F HOTEL</p>
    </footer>
</body>

</html>