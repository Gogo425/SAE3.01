<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>
<body>
    
    <h1>Informations du compte</h1>
    @auth
        {{Illuminate\Support\Facades\Auth::user();}}
    @endauth
    @guest
        <p>Vous n'êtes pas connecté</p>
    @endguest
    <a href="/"> Accueil </a>
    <?php
    dd(Session::all());
    ?>
</body>
</html>