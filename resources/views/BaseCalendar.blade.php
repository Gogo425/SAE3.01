<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    
</head>
<body>
    <img src="{{ asset('img/logo.png') }}" alt="logo" height="8%" width="8%">
    <button class="custom-button">Profil</button>
    <button class="custom-button">Déconnexion</button>
    <button class="custom-button">Liste d'élèves et d'initiateurs</button>
    <button class="custom-button">Liste de formations</button>
    <button class="custom-button">Consulter ma formation</button>
    <button class="custom-button"><a href="{{ asset('calendar/calendarDirector') }}">Consulter l'emploi du temps Responsable de Formation</a></button>
    <button class="custom-button"><a href="{{ asset('calendar/calendarStudent') }}">Consulter l'emploi du temps élèves</a></button>
    <button class="custom-button"><a href="{{ asset('calendar/calendarInitiator') }}">Consulter l'emploi du temps Initiateur</a></button>

    @yield('link')
    
</body>
</html>