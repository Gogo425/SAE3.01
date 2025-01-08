<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title> 
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
</head>

<body style="background-image: url('{{ asset('img/fondEcran.jpg') }}');" class="bg-cover bg-center place-self-center  ">
@include("header")
<p>{{Auth::check()}}</p>
<form method="post" action="/login">
    @csrf
    <p class="text-xl text-center"> Connexion </p>
    
    <div class="flex justify-center p-4">
        <label for="email" class="px-4"> Email </label>
        <input type="email" name="email" id="email" >
    </div>
    
    <div class="flex justify-center p-4">
        <label for="password" class="px-4"> Password </label>
        <input type="password" name="password" id="password">
    </div>
    
    <div class="flex justify-center">
            <input type="submit" class="text-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" value="Se Connecter">
        </div>
    @include("footer")
</form>

</body>

    

</html>