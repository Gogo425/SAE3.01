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
    <button>Profil</button>
    <button>Déconnexion</button>
    <button>Liste d'élèves et d'initiateurs</button>
    <button>Liste de formations</button>
    <button>Consulter ma formation</button>
    <button><a href="{{ asset('calendar/calendarDirector') }}">Consulter l'emploi du temps</a></button>

    @yield('link')
    
</body>
</html>