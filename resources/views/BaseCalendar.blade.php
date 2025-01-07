<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    
</head>
<body>
    <img src="{{ asset('image/logo.png') }}" alt="logo" height="8%" width="8%">

    @yield('content')
    
</body>
</html>