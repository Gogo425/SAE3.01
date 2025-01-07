<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
    <title>Connexion</title>
</head>
<body>
    <form action="" method="post">

        @csrf

        <label for="EMAIL">Email</label>
        <input type="EMAIL" id="EMAIL" name="EMAIL" class="border-solid border-2" required value={{old('EMAIL')}} >
        @error('EMAIL')
            {{$message}}
        @enderror

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" class="border-solid border-2" required>
        @error('password')
            {{$message}}
        @enderror

        <input type="submit" value="Se Connecter" >

    </form>
</body>
</html>