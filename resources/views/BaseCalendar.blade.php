<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
    <script defer src="../js/homePage.js"></script>
    <title>@yield('title')</title>
</head>
<body>
    @include('header')

    @yield('link')
    
    @include('footer')
</body>
</html>