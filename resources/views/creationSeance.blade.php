<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>Création d'une séance</title>
    </head>
    <header>
        <img src="{{ asset('image/logo.png') }}" alt="logo"/>
        <button>Profil</button>
        <button>Déconnexion</button>
    </header>
    <body>
        @if(session('success'))
            <p style="color: green;">{{session('success')}}</p>
        @endif
        <form action="{{ route('seance.save') }}" method="POST" id="formulaire">
            @csrf
            <label>Date :</label>
            <input type="date" id="dateSession" name="dateSession" required/> <!-- vérifier que la date n'est pas avant date du jour-->

            <select name="location" id="location">
                    <option value="">--choisir un type de location--</option>

                    @foreach ($locations as $location)

                        <option value = "{{$location->TYPE}}">{{ $location->TYPE }}</option>

                    @endforeach
            </select>
            <p name="test" id="test">Test</p>
            <br>
            <div id="students">
                @foreach($students as $index => $student)
                    <div id='student_{{ $index + 1 }}'>
                        <select name="student{{ $index + 1 }}" id="student{{ $index + 1 }}"> <!--vérifier qu'il n'y est pas 2 fois le même élève-->
                            <option value="{{ $student->NAME }}">{{ $student->NAME }}</option>
                        </select>

                        <select name="abilities1{{ $index + 1 }}" id="abilities1{{ $index + 1 }}"> <!--vérifier qu'il n'y a pas 2 fois la même abilities -->
                            <option value="">--choisir une aptitude--</option>

                            @foreach ($abilities as $abilitie)

                                <option value ="{{ $abilitie->DESCRIPTION }}">{{ $abilitie->DESCRIPTION }}</option>

                            @endforeach
                        </select>

                        <select name="abilities2{{ $index + 1 }}" id="abilities2{{ $index + 1 }}">
                            <option value="">--choisir une aptitude--</option>

                            @foreach ($abilities as $abilitie)

                                <option value ="{{ $abilitie->DESCRIPTION }}">{{ $abilitie->DESCRIPTION }}</option>

                            @endforeach
                        </select>

                        <select name="abilities3{{ $index + 1 }}" id="abilities3{{ $index + 1 }}">
                            <option value="">--choisir une aptitude--</option>

                            @foreach ($abilities as $abilitie)

                                <option value ="{{ $abilitie->DESCRIPTION }}">{{ $abilitie->DESCRIPTION }}</option>

                            @endforeach
                        </select>

                        <select name="initiator{{ $index + 1 }}" id="initiator{{ $index + 1 }}">
                            <option value="">--choisir un initiateur--</option>

                            @foreach ($initiators as $initiator)

                                <option value ="{{ $initiator->NAME }}">{{ $initiator->NAME }}</option>

                            @endforeach
                        </select>
                    </div>
                    <br>
                @endforeach
            </div>

            <button type="submit">Créer une séance</button>
        </form>
        <!--<button onclick="addStudent()">Ajouter un elève</button>-->
        <button>Annuler</button> <!--revenir à l'accueil-->


        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
    </body>
</html>