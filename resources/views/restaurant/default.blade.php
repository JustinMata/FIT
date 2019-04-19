<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('restaurant.partials.head')
</head>
<body>

    @include('restaurant.partials.nav')

    @yield('header')

    @yield('content')

    @include('restaurant.partials.footer')
    @include('restaurant.partials.footer-scripts')

    @yield('map')

</body>
</html>
