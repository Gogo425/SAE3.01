<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accueil</title>
    </head>
    <body>
        <p>{{Auth::check()}}</p>
        <p><a href=""><img src="../image/logo.png" alt="logo"></p>
        <a href="/profile">Profil</a>
        <a href="/logout">Déconnexion</a>
        <button>Déconnexion</button>
    </header>
    <body>
        <button>Liste d'élèves et d'initiateurs</button>
        <button>Liste de formations</button>
        <button>Consulter ma formation</button>
        <button><a href="{{ asset('calendar/calendarDirector') }}">Consulter l'emploi du temps Responsable de Formation</a></button>
        <button><a href="{{ asset('calendar/calendarStudent') }}">Consulter l'emploi du temps élèves</a></button>
        <button><a href="{{ asset('calendar/calendarInitiator') }}">Consulter l'emploi du temps Initiateur</a></button>
    </body>
    <?php
    ?>
</html>