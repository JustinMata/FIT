<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('driver.partials.head')
</head>
<body>

    @include('driver.partials.nav')

    @yield('header')

    @yield('content')

    @include('driver.partials.footer')
    @include('driver.partials.footer-scripts')

    @yield('map')

    @yield('scripts')

</body>
</html>
