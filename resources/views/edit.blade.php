<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations de compte</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <h1>Modifier les informations de compte</h1>
    <form action="{{ route('persons.update', $user->ID_PER) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="{{ $user->NAME }}" required />
        </div>
        <div>
            <label for="surname">Prénom</label>
            <input type="text" name="surname" id="surname" value="{{ $user->SURNAME }}" required />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->EMAIL }}" required />
        </div>
        <div>
            <label for="adress">Adresse</label>
            <input type="text" name="adress" id="adress" value="{{ $user->ADRESS }}" />
        </div>
        <div>
            <label for="medical_certificate_date">Date du certificat médical</label>
            <input type="date" name="medical_certificate_date" id="medical_certificate_date" value="{{ $user->MEDICAL_CERTIFICATE_DATE}}" />
        </div>
        <div>
            <button type="submit">Modifier</button>
        </div>
    </form>
</body>
</html>
