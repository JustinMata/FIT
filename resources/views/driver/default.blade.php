<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('driver.partials.head')
</head>
<body>

    @include('driver.partials.nav')

    @yield('driver.header')

    @yield('driver.content')

    @include('driver.partials.footer')
    @include('driver.partials.footer-scripts')

</body>
</html>
