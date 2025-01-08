@extends('base')



@section('title', 'acceuil')

@section("content")


    <p>{{Auth::check()}}</p>
    <form method="post" action="/login">
        @csrf

        <label for="email"> Email </label>
        <input type="email" name="email" id="email">
        <label for="password"> Password </label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Se Connecter">
    </form>
@endsection
</html>