<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header>
        @widget('menu')
    </header>

    <div class="main-content">
        @yield('content')
    </div>

    @include('frontend.partials.footer')

    <div class="menu-mobile">
        <div class="menu-mobile-lk">
            <a href="#" class="menu-mobile-lk__register">Регистрация</a>
            <a href="#" class="menu-mobile-lk__login">Вход</a>
        </div>
        <ul class="menu-mobile-ul">
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">Главная</a></li>
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">Услуги<i class="fas fa-chevron-right"></i></a></li>
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">Оплата</a></li>
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">Товары</a></li>
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">Доставка<i class="fas fa-chevron-right"></i></a></li>
            <li class="menu-mobile-ul__li"><a href="#" class="menu-mobile-ul__li-link">О компании</a></li>
        </ul>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/frontend.js') }}" defer></script>
@stack('after-scripts')
</body>
</html>