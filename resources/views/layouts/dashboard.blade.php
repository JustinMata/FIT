<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
</head>
<body>

    @include('layouts.partials.nav')

    @yield('header')

    @yield('content')

    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
</html>
