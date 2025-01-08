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
        <button>Déconnexion</button>
        <button>Liste d'élèves et d'initiateurs</button>
        <button>Liste de formations</button>
        <button>Consulter ma formation</button>
        <button>Consulter l'emploi du temps</button>
    </body>
    <?php
    dd(Auth::user());
    ?>
</html>