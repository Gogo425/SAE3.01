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
    <label for="email"> Email </label>
    <input type="email" name="email" id="email">
    <label for="password"> Password </label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Se Connecter">
    @include("footer")
</form>

</body>

    

</html>