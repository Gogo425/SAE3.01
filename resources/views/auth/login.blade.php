<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <form action="" method="post">

        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value={{old('email')}} >
        @error('email')
            {{$message}}
        @enderror

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        @error('email')
            {{$message}}
        @enderror

        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>