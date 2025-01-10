<?php  use Illuminate\Support\Arr;?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sessionStyle.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="../js/tailwind.config.js"></script>

        <title>Création d'une séance</title>
    </head>
    @include('header')
    <body>
        <form action="{{ route('seance.save') }}" method="POST" id="formulaire">
            @csrf
            <label>Date : </label>
            <input type="date" value="{{ $date_session }}" id="dateSession" name="dateSession" min="<?php $d= strtotime("+1 day"); echo date("Y-m-d", $d); ?>" required/> 

            <select name="location" id="location" required>
                    <option value="">--choisir un type de location--</option>

                    @foreach ($locations as $location)

                        <option value = "{{$location->TYPE}}">{{ $location->TYPE }}</option>

                    @endforeach
            </select>

            <br>
            <div id="students">
                @foreach($students as $index => $student)
                    <div class="student" id='student_{{ $index + 1 }}'>
                        <select class="nomStudent" name="student{{ $index + 1 }}" id="student{{ $index + 1 }}"> <!--vérifier qu'il n'y est pas 2 fois le même élève-->
                            <option value="{{ $student->NAME }}">{{ $student->NAME }}</option>
                        </select>

                        <select name="abilities1{{ $index + 1 }}" id="abilities1{{ $index + 1 }}"> <!--vérifier qu'il n'y a pas 2 fois la même abilities -->
                            <option value="">--choisir une aptitude--</option>

                            @foreach (Arr::get($abilities, $index) as $abilitie)

                                <option value ="{{ $abilitie->DESCRIPTION }}">{{ $abilitie->DESCRIPTION }}</option>

                            @endforeach
                        </select>

                        <select name="abilities2{{ $index + 1 }}" id="abilities2{{ $index + 1 }}">
                            <option value="">--choisir une aptitude--</option>

                            @foreach (Arr::get($abilities, $index) as $abilitie)

                                <option value ="{{ $abilitie->DESCRIPTION }}">{{ $abilitie->DESCRIPTION }}</option>

                            @endforeach
                        </select>

                        <select name="abilities3{{ $index + 1 }}" id="abilities3{{ $index + 1 }}">
                            <option value="">--choisir une aptitude--</option>

                            @foreach (Arr::get($abilities, $index) as $abilitie)

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

            <!-- Button container with both buttons aligned horizontally -->
            <div class="form-buttons">
                <button id="studentButton" type="submit">Créer une séance</button>
                <button type="button" id="cancelButton">Annuler</button> <!-- Cancel button to return to home or previous page -->
            </div>
        </form>

        @if(session('success'))
            <p style="color: green; text-align: center;">{{session('success')}}</p>
        @endif
        @if(session('failure'))
            <p style="color: red; text-align: center;">{{session('failure')}}</p>
        @endif

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        @include('footer')
    </body>
</html>