<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.head')
</head>
<body>

    @include('admin.partials.nav')

    @yield('admin.header')

    @yield('admin.content')

    @include('admin.partials.footer')
    @include('admin.partials.footer-scripts')

</body>
</html>
