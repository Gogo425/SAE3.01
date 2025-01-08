@extends('base')


        <title>Accueil</title>
    </head>
    <body>
        <p>{{Auth::check()}}</p>
        <p><a href=""><img src="../image/logo.png" alt="logo"></p>
        <a href="/profile">Profil</a>
        <a href="/logout">Déconnexion</a>
        <button>Déconnexion</button>


@section('title', 'acceuil')

@section('content')

        <button>Liste d'élèves et d'initiateurs</button>
        <button>Liste de formations</button>
        <button>Consulter ma formation</button>
        <button>Consulter l'emploi du temps</button>

    </body>
    <?php
    dd(Auth::user());
    ?>
</html>

@endsection


